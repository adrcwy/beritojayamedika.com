<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // ... boot() ...

    protected $commands = [
        // Daftarkan command lama jika tidak otomatis
        // Commands\ScrapeInaproc::class,
        // Commands\ScrapeInaprocBulk::class, // Tidak perlu didaftarkan secara manual jika di folder Commands
    ];

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
