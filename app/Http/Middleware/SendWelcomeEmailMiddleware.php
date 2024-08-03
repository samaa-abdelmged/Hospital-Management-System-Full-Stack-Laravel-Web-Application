<?php

namespace App\Http\Middleware;

use App\Events\LoginEvent;
use App\Jobs\SendWelcomeEmailJob;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class SendWelcomeEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            SendWelcomeEmailJob::dispatch();
            Event::dispatch(new LoginEvent());

        }

        return $next($request);
    }
}