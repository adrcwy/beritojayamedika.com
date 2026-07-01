<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RepairProducts extends Command
{
    protected $signature = 'products:repair-all
                            {--limit= : Maksimal produk untuk repair gambar/deskripsi terpotong}
                            {--delay=250 : Jeda antar request dalam milidetik}
                            {--delete-unrepairable-images : Hapus produk yang gambar/link-nya tidak bisa diperbaiki}
                            {--dry-run : Cek saja tanpa update atau delete}';

    protected $description = 'Jalankan cleanup deskripsi, repair deskripsi terpotong, dan download ulang gambar produk';

    public function handle(): int
    {
        $limit = $this->option('limit');
        $delay = $this->option('delay');
        $dryRun = (bool) $this->option('dry-run');

        $this->info('1/3 Membersihkan deskripsi dari TKDN, [object Object], dan teks rusak...');
        $cleanOptions = [];
        if ($dryRun) {
            $cleanOptions['--dry-run'] = true;
        }
        $cleanStatus = $this->call('products:clean-descriptions', $cleanOptions);

        $this->info('2/3 Mengambil ulang deskripsi lengkap yang masih terpotong...');
        $descriptionOptions = ['--delay' => $delay];
        if ($limit) {
            $descriptionOptions['--limit'] = $limit;
        }
        if ($dryRun) {
            $descriptionOptions['--dry-run'] = true;
        }
        $descriptionStatus = $this->call('products:repair-truncated-descriptions', $descriptionOptions);

        $this->info('3/3 Download ulang gambar produk yang kosong/file-nya hilang...');
        $imageOptions = ['--delay' => $delay];
        if ($limit) {
            $imageOptions['--limit'] = $limit;
        }
        if ($this->option('delete-unrepairable-images')) {
            $imageOptions['--delete-unrepairable'] = true;
        }
        if ($dryRun) {
            $imageOptions['--dry-run'] = true;
        }
        $imageStatus = $this->call('products:repair-images', $imageOptions);

        if ($cleanStatus !== self::SUCCESS || $descriptionStatus !== self::SUCCESS || $imageStatus !== self::SUCCESS) {
            $this->warn('Repair selesai, tapi ada salah satu tahap yang memberi status gagal.');

            return self::FAILURE;
        }

        $this->info('Repair produk selesai.');

        return self::SUCCESS;
    }
}
