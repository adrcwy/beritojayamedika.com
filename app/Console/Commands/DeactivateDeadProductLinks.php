<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DeactivateDeadProductLinks extends Command
{
    protected $signature = 'products:deactivate-dead-links {--limit=0}';

    protected $description = 'Nonaktifkan produk aktif yang link katalog INAPROC-nya sudah tidak dapat diakses.';

    public function handle(): int
    {
        $query = Product::query()
            ->where('is_active', true)
            ->whereNotNull('catalog_link')
            ->where('catalog_link', '!=', '');

        if ((int) $this->option('limit') > 0) {
            $query->limit((int) $this->option('limit'));
        }

        $checked = 0;
        $inactive = 0;

        $query->chunkById(50, function ($products) use (&$checked, &$inactive) {
            foreach ($products as $product) {
                $checked++;

                if (! $this->isLinkAlive($product->catalog_link)) {
                    $product->forceFill(['is_active' => false])->save();
                    $inactive++;
                    $this->warn("Inactive: {$product->id} {$product->name}");
                }
            }
        });

        $this->info("Checked: {$checked}");
        $this->info("Inactive: {$inactive}");

        return self::SUCCESS;
    }

    private function isLinkAlive(string $url): bool
    {
        try {
            $response = Http::timeout(12)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; BeritoJayaMedikaBot/1.0)',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                ])
                ->get($url);

            if ($response->status() === 404 || $response->status() === 410) {
                return false;
            }

            if ($response->serverError()) {
                return true;
            }

            $body = strtolower(strip_tags(substr($response->body(), 0, 8000)));

            return ! str_contains($body, 'tidak ditemukan')
                && ! str_contains($body, 'not found')
                && ! str_contains($body, 'produk tidak tersedia');
        } catch (\Throwable) {
            return true;
        }
    }
}
