<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckLastActivity
{
    public function handle(Request $request, Closure $next)
    {
        $token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token);
        $jti = $payload->get('jti');

        $session = DB::table('user_sessions')->where('token_jti', $jti)->first();

        if (! $session) {
            return response()->json(['message' => 'Sesión inválida'], 401);
        }

        $timeout = config('auth.inactivity_timeout');

        if (Carbon::parse($session->last_activity)->diffInMinutes(now()) >= $timeout) {
            JWTAuth::invalidate($token);
            DB::table('user_sessions')->where('token_jti', $jti)->delete();

            return response()->json([
                'message' => 'Sesión expirada por inactividad'
            ], 401);
        }

        DB::table('user_sessions')
            ->where('token_jti', $jti)
            ->update([
                'last_activity' => now(),
                'updated_at' => now()
            ]);

        return $next($request);
    }
}
