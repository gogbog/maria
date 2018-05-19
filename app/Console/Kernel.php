<?php

namespace App\Console;

use App\Console\Commands\albumsToTranslation;
use App\Console\Commands\eventsToTranslation;
use App\Console\Commands\newsToTranslation;
use App\Console\Commands\songsToTranslation;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        eventsToTranslation::class,
        newsToTranslation::class,
        albumsToTranslation::class,
        songsToTranslation::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
