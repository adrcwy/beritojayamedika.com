<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Support\MediaPath;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RepairProductImages extends Command
{
    protected $signature = 'products:repair-images
                            {--limit= : Maksimal produk yang diproses}
                            {--delay=250 : Jeda antar request dalam milidetik}
                            {--delete-unrepairable : Hapus produk yang gambar/link-nya tidak bisa diperbaiki}
                            {--dry-run : Cek saja tanpa update atau delete}';

    protected $description = 'Download ulang gambar produk yang kosong atau file gambarnya hilang dari link INAPROC';

    private array $repeatedImageHashes = [];

    public function handle(): int
    {
        $limit = $this->option('limit') ? (int) $this->option('limit') : null;
        $delay = max(0, (int) $this->option('delay'));
        $dryRun = (bool) $this->option('dry-run');
        $deleteUnrepairable = (bool) $this->option('delete-unrepairable');
        $checked = 0;
        $updated = 0;
        $deleted = 0;
        $failed = 0;
        $this->repeatedImageHashes = $this->findRepeatedImageHashes();

        $products = Product::query()
            ->select('id', 'name', 'image', 'catalog_link')
            ->orderBy('id')
            ->get()
            ->filter(fn (Product $product) => $this->needsImageRepair($product));

        if ($limit !== null) {
            $products = $products->take($limit);
        }

        $this->info("Produk perlu dicek: {$products->count()}");

        foreach ($products as $product) {
            $checked++;
            $this->line("[{$checked}/{$products->count()}] {$product->name}");

            if (!$product->catalog_link) {
                $this->warn('  tidak punya catalog_link');
                $this->deleteIfRequested($product, $deleteUnrepairable, $dryRun, $deleted, $failed);
                continue;
            }

            try {
                $html = $this->fetchProductPage($product->catalog_link);
                $imageUrl = $this->extractImageUrl($html);

                if (!$imageUrl) {
                    $this->warn('  URL gambar tidak ditemukan');
                    $this->deleteIfRequested($product, $deleteUnrepairable, $dryRun, $deleted, $failed);
                    continue;
                }

                $imagePath = $this->downloadImage($imageUrl, $product->name, $dryRun);

                if (!$imagePath) {
                    $this->warn('  download gambar gagal');
                    $this->deleteIfRequested($product, $deleteUnrepairable, $dryRun, $deleted, $failed);
                    continue;
                }

                if ($dryRun) {
                    $this->info("  akan diperbarui: {$imagePath}");
                } else {
                    $product->forceFill(['image' => $imagePath])->save();
                    $this->info("  gambar diperbarui: {$imagePath}");
                }

                $updated++;
            } catch (\Throwable $e) {
                $this->warn('  gagal: ' . $e->getMessage());
                $this->deleteIfRequested($product, $deleteUnrepairable, $dryRun, $deleted, $failed);
            }

            if ($delay > 0) {
                usleep($delay * 1000);
            }
        }

        $this->info("Selesai. Dicek: {$checked}, gambar diperbarui: {$updated}, dihapus: {$deleted}, gagal/tetap kosong: {$failed}");

        return self::SUCCESS;
    }

    private function needsImageRepair(Product $product): bool
    {
        return ! MediaPath::exists($product->image) || $this->isRepeatedStoredImage($product);
    }

    private function fetchProductPage(string $url): string
    {
        $response = Http::timeout(30)
            ->retry(2, 500)
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
            ])
            ->get($url);

        if (!$response->successful()) {
            throw new \RuntimeException("HTTP {$response->status()}");
        }

        return $response->body();
    }

    private function extractImageUrl(string $html): ?string
    {
        $candidates = [];
        $rscData = '';

        if (preg_match_all('#self\.__next_f\.push\(\[1,"(.+?)"\]\)#s', $html, $chunks)) {
            foreach ($chunks[1] as $chunk) {
                $rscData .= stripcslashes($chunk);
            }
        }

        if ($rscData !== '') {
            preg_match_all('#"imageUrl"\s*:\s*"((?:\\\\.|[^"\\\\])+)\"#', $rscData, $matches);
            foreach ($matches[1] ?? [] as $candidate) {
                $candidates[] = stripcslashes($candidate);
            }
        }

        foreach ([
            '#<meta\s+property="og:image"\s+content="([^"]+)"#i',
            '#<meta\s+name="twitter:image"\s+content="([^"]+)"#i',
        ] as $pattern) {
            if (preg_match($pattern, $html, $match)) {
                $candidates[] = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
        }

        foreach ($candidates as $candidate) {
            $candidate = trim($candidate);

            if (
                filter_var($candidate, FILTER_VALIDATE_URL)
                && !str_contains($candidate, 'logo-katalog')
                && !str_contains($candidate, 'buyer-banner')
                && !str_contains($candidate, 'favicon')
                && ! $this->isBadImageCandidate($candidate)
            ) {
                return $candidate;
            }
        }

        return null;
    }

    private function downloadImage(string $imageUrl, string $productName, bool $dryRun = false): ?string
    {
        $response = Http::timeout(30)
            ->retry(2, 500)
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            ])
            ->get($imageUrl);

        if (!$response->successful() || $response->body() === '') {
            return null;
        }

        $contentType = strtolower((string) $response->header('Content-Type'));
        if (!str_contains($contentType, 'image/')) {
            return null;
        }

        $extension = match (true) {
            str_contains($contentType, 'png') => 'png',
            str_contains($contentType, 'webp') => 'webp',
            str_contains($contentType, 'gif') => 'gif',
            default => pathinfo(parse_url($imageUrl, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION) ?: 'jpg',
        };

        $extension = strtolower(preg_replace('/[^a-z0-9]/i', '', $extension) ?: 'jpg');
        $filename = 'products/auto_' . Str::slug($productName) . '_' . Str::random(8) . '.' . $extension;

        if ($dryRun) {
            return $filename;
        }

        Storage::disk('public')->put($filename, $response->body());

        return $filename;
    }

    private function isBadImageCandidate(string $url): bool
    {
        $url = rawurldecode(strtolower($url));

        foreach ([
            '404',
            'not-found',
            'notfound',
            'no-image',
            'no_image',
            'placeholder',
            'empty-state',
            'error-page',
            'img-not',
        ] as $needle) {
            if (str_contains($url, $needle)) {
                return true;
            }
        }

        return false;
    }

    private function findRepeatedImageHashes(): array
    {
        $hashes = [];

        Product::query()
            ->select('id', 'image', 'catalog_link')
            ->whereNotNull('catalog_link')
            ->where('catalog_link', '!=', '')
            ->whereNotNull('image')
            ->chunkById(100, function ($products) use (&$hashes) {
                foreach ($products as $product) {
                    $file = $this->localImageFile($product->image);

                    if (! $file) {
                        continue;
                    }

                    $hash = @hash_file('sha256', $file);

                    if ($hash) {
                        $hashes[$hash] = ($hashes[$hash] ?? 0) + 1;
                    }
                }
            });

        return array_keys(array_filter($hashes, fn (int $count) => $count >= 5));
    }

    private function isRepeatedStoredImage(Product $product): bool
    {
        if ($this->repeatedImageHashes === [] || ! $product->catalog_link) {
            return false;
        }

        $file = $this->localImageFile($product->image);
        $hash = $file ? @hash_file('sha256', $file) : null;

        return $hash !== null && in_array($hash, $this->repeatedImageHashes, true);
    }

    private function localImageFile(?string $path): ?string
    {
        $path = MediaPath::normalize($path);

        if ($path === '') {
            return null;
        }

        $storageFile = storage_path('app/public/' . $path);
        if (is_file($storageFile)) {
            return $storageFile;
        }

        $publicFile = public_path('storage/' . $path);
        return is_file($publicFile) ? $publicFile : null;
    }

    private function deleteIfRequested(Product $product, bool $deleteUnrepairable, bool $dryRun, int &$deleted, int &$failed): void
    {
        if (!$deleteUnrepairable) {
            $failed++;
            return;
        }

        if ($dryRun) {
            $this->warn('  akan dihapus karena tidak bisa diperbaiki');
        } else {
            $product->delete();
            $this->warn('  dihapus karena tidak bisa diperbaiki');
        }

        $deleted++;
    }
}
