<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class EmployeeAuthExceptionHandler extends AuthenticationException
{
    protected function unauthenticated(Request $request, AuthenticationException $exception)
    {
        // **تحقق ما إذا كان المستخدم يحاول الوصول إلى مسار محمي بحساب admin:**
        if ($request->is('admin')) {
            // **إذا كان المستخدم مُسجل الدخول كـ employee:**
            if (auth()->user()->is('employee')) {
                // **تغيير نوع المستخدم إلى employee:**
                auth()->login(auth()->user(), ['remember' => $request->get('remember')]);
                // **إعادة توجيه المستخدم إلى مسار employee:**

            }
        }

        // **إذا لم يكن المستخدم مُسجل الدخول أو لم يتم تغيير نوع المستخدم،**
        // **استدعاء طريقة unauthenticated الأصلية:**
        return parent::unauthenticated($request, $exception);
    }

}