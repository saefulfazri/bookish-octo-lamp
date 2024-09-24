<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\RekapAbsensiCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Jadwalkan perintah rekap untuk dijalankan setiap hari pada tengah malam
        $schedule->command('rekap:absensi')->dailyAt('23:59');

    }
    // If you're using Laravel 8 or higher, ensure to use the correct method signature
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
