<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;


class ApiUserAuth
{

    public function handle($request, Closure $next)
    {
        if ($request->has('api_token') && $request->api_token !== null) {

            $user = User::query()->where('api_token', '=', $request->api_token)->first();
            if ($user !== null) {

                return $next($request);
            }

            return response()->json('api token cant be empty');
        }

        return response()->json('api token not sent');
    }
}
