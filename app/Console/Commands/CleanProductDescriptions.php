<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Support\ProductDescriptionCleaner;
use Illuminate\Console\Command;

class CleanProductDescriptions extends Command
{
    protected $signature = 'products:clean-descriptions {--dry-run : Tampilkan jumlah perubahan tanpa menyimpan}';

    protected $description = 'Bersihkan deskripsi produk dari teks TKDN, [object Object], HTML, dan spasi rusak';

    public function handle(): int
    {
        $changed = 0;
        $truncated = 0;
        $dryRun = (bool) $this->option('dry-run');

        Product::query()
            ->select('id', 'name', 'description')
            ->orderBy('id')
            ->chunkById(100, function ($products) use (&$changed, &$truncated, $dryRun) {
                foreach ($products as $product) {
                    $clean = ProductDescriptionCleaner::clean($product->description);

                    if (ProductDescriptionCleaner::looksTruncated($clean)) {
                        $truncated++;
                    }

                    if ($clean === (string) $product->description) {
                        continue;
                    }

                    $changed++;

                    if (!$dryRun) {
                        $product->forceFill([
                            'description' => $clean === '' ? '-' : $clean,
                        ])->save();
                    }
                }
            });

        $this->info(($dryRun ? 'Perlu dibersihkan' : 'Dibersihkan') . ": {$changed} produk");
        $this->info("Masih terlihat terpotong dari sumber data: {$truncated} produk");

        return self::SUCCESS;
    }
}
