<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Jobs\Job;

class PrintHelloJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue;
    public function handle()
    {
        //   throw new Exception('فشل تنفيذ المهمة!');
        echo 'Welcome Samaa!';

    }
}