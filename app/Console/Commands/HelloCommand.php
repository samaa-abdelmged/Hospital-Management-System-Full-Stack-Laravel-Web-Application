<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HelloCommand extends Command
{
    /**
     * The name and description of the command.
     *
     * @var string
     */
    protected $name = 'hello:command';
    protected $description = 'Prints a greeting message.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('hi samaa!');
    }
}