<?php

namespace App\Jobs;

use App\Mail\loginMail;
use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // to run -> php artisan queue:work
    public $admin;

    public function handle()
    {
        $this->admin = Auth::user();

        $admin = Admin::find($this->admin);

        if ($admin) {
            Mail::to($admin)->send(new loginMail);
        }


    }
}