<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class WelcomeAndRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // عرض رسالة ترحيب للمستخدم المسجل الدخول
            $user = Auth::user();
            Session::flash('message', "مرحبا $user->name!");
        }

        // استمر في تنفيذ وحدة التحكم
        $response = $next($request);

        // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
        return redirect('/login');
    }
}