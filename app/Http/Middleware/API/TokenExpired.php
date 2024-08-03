<?php

namespace App\Http\Middleware\API;

use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiTrait;

class TokenExpired
{
    use ApiTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->bearerToken();

        if (!$token) {
            throw new AuthenticationException('Missing token');
        }

        try {
            Auth::guard('admin-api')->user();
        } catch (AuthenticationException $e) {
            throw new AuthenticationException('Invalid token');
        }

        return $next($request);


        /*
                $token = $request->bearerToken();
                if (!$token || !Auth::guard('admin-api')->user()) {
                    return $this->returnError(500, 'Error something went!');

                }

                return $next($request);
        */

    }
}