<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginEvent;
use App\Http\Controllers\Controller;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Foundation\Auth\AuthenticatesAdmins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesAdmins;


    /**
     * Where to redirect users after login.
     *
     * @var string
     *///  protected $redirectTo = '/dashboard/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}