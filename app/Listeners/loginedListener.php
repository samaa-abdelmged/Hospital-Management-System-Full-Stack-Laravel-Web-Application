<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Mail\loginMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class loginedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoginEvent $event)
    {

        Mail::to(Auth::user()->email)->send(new loginMail());
    }
}