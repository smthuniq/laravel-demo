<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserIdType
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
        $userIdType = $request->query('user_id_type');
        $allowedIdTypes = [
            'name',
        ];
        if (!in_array($userIdType, $allowedIdTypes, true)) {
            return response()->json([], 400);
        }
        return $next($request);
    }
}
