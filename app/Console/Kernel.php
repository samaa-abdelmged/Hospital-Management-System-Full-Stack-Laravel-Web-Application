<?php

namespace App\Console;

use App\Console\Commands\HelloCommand;
use App\Jobs\PrintHelloJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //to run -> php artisan commande_name
        // ... أوامر أخرى ...
        'hello:command' => Commands\HelloCommand::class,
    ];


    /**
     * Define the application's command schedule.
     */


    protected function schedule(Schedule $schedule): void
    {
        //   ->  to run php artisan schedule:work
        //
        //runinbackground -> to run more than job in the same time

        $schedule->command('inspire')->everyMinute();
        $schedule->job(new PrintHelloJob)->everyMinute();
        $schedule->command('hello:command')
            ->sendOutputTo('storage/logs/message.log')
            ->everyMinute()
            ->before(function () {
                // قبل بداية المهمة...
                Log::info('before');

            })
            ->after(function () {
                // بعد المهمة ..
                Log::info('after');

            });

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}