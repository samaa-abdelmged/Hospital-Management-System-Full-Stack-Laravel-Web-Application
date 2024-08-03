<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class FixTransactionLevelsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Queue::looping(function () {
            // **الحصول على اتصال قاعدة البيانات**
            $connection = DB::connection();

            // **الحصول على مستوى المعاملات الحالي**
            $transactionLevel = $connection->getTransactionLevel();

            // **التراجع عن جميع المعاملات المفتوحة**
            while ($transactionLevel > 0) {
                $connection->rollBack();
                $transactionLevel--;
            }
        });
    }
}