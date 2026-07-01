<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Support\ProductDescriptionCleaner;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RepairTruncatedProductDescriptions extends Command
{
    protected $signature = 'products:repair-truncated-descriptions
                            {--limit= : Maksimal produk yang diproses}
                            {--delay=300 : Jeda antar request dalam milidetik}
                            {--dry-run : Cek dan ambil kandidat deskripsi tanpa menyimpan ke database}';

    protected $description = 'Ambil ulang deskripsi lengkap INAPROC untuk produk yang masih terpotong';

    public function handle(): int
    {
        $limit = $this->option('limit') ? (int) $this->option('limit') : null;
        $delay = max(0, (int) $this->option('delay'));
        $dryRun = (bool) $this->option('dry-run');
        $checked = 0;
        $updated = 0;
        $failed = 0;

        $query = Product::query()
            ->whereNotNull('catalog_link')
            ->where('catalog_link', '!=', '')
            ->orderBy('id');

        $products = $query->get()->filter(function (Product $product) {
            return ProductDescriptionCleaner::looksTruncated(ProductDescriptionCleaner::clean($product->description));
        });

        if ($limit !== null) {
            $products = $products->take($limit);
        }

        $this->info("Produk perlu dicek: {$products->count()}");

        foreach ($products as $product) {
            $checked++;
            $this->line("[{$checked}/{$products->count()}] {$product->name}");

            try {
                $response = Http::timeout(30)
                    ->retry(2, 500)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                        'Accept-Language' => 'id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
                    ])
                    ->get($product->catalog_link);

                if (!$response->successful()) {
                    $failed++;
                    $this->warn("  gagal HTTP {$response->status()}");
                    continue;
                }

                $description = $this->extractDescriptionFromHtml($response->body());

                if (
                    $description === '-'
                    || ProductDescriptionCleaner::looksTruncated($description)
                    || mb_strlen($description) <= mb_strlen(ProductDescriptionCleaner::clean($product->description))
                ) {
                    $failed++;
                    $this->warn('  deskripsi penuh belum ditemukan');
                    continue;
                }

                if ($dryRun) {
                    $this->info('  kandidat deskripsi lengkap ditemukan (dry-run)');
                } else {
                    $product->forceFill(['description' => $description])->save();
                    $this->info('  diperbarui');
                }

                $updated++;
            } catch (\Throwable $e) {
                $failed++;
                $this->warn('  gagal: ' . $e->getMessage());
            }

            if ($delay > 0) {
                usleep($delay * 1000);
            }
        }

        $label = $dryRun ? 'kandidat ditemukan' : 'diperbarui';
        $this->info("Selesai. Dicek: {$checked}, {$label}: {$updated}, gagal/tetap pendek: {$failed}");

        return self::SUCCESS;
    }

    private function extractDescriptionFromHtml(string $html): string
    {
        $rscData = '';

        if (preg_match_all('#self\.__next_f\.push\(\[1,"(.+?)"\]\)#s', $html, $chunks)) {
            foreach ($chunks[1] as $chunk) {
                $rscData .= stripcslashes($chunk);
            }
        }

        if ($rscData === '') {
            return '-';
        }

        preg_match_all('#"description"\s*:\s*"((?:\\\\.|[^"\\\\]){20,})"#s', $rscData, $matches);

        foreach ($matches[1] ?? [] as $candidate) {
            $candidate = ProductDescriptionCleaner::clean(stripcslashes($candidate));

            if (
                $candidate !== ''
                && $candidate !== '-'
                && stripos($candidate, 'Katalog Elektronik') === false
                && stripos($candidate, 'Portal resmi') === false
                && !ProductDescriptionCleaner::looksTruncated($candidate)
            ) {
                return $candidate;
            }
        }

        return '-';
    }
}
