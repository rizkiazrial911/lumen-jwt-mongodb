<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\User;
class LoginMiddleware
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
        // Pre-Middleware Action

        $response = $next($request);
        $token = $request->bearerToken();
        if($token) {
            $check =  User::where('api_token', $token)->first();
            if (!$check) {
                return response()->json(["message" => "Token invalid"], 401);
            } else {
                return $next($request);
            }
        } else {
            return response()->json(["message" => "Unauthorized"], 401);
        }


        // Post-Middleware Action

        return $response;
    }
}
