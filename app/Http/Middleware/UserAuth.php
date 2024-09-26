<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = auth('api');
        $access_token= trim(Str::replaceFirst('Bearer ', '', $request->header('Authorization')));
        if (!$auth->user()) {
            $array = [
                'data' => null,
                'status' => false,
                'message' => "",
                'error' =>  [__('messages.UNAUTHORISED')]
            ];
            return response($array, 401);
        }
        $user=$auth->user();
        if (empty($user->current_access_token) && !empty($access_token)){
            $user->current_access_token= $access_token;
            $user->save();
        }elseif ($user->current_access_token != $access_token){
//            JWTAuth::invalidate($access_token);
            $auth->logout(true);
            $array = [
                'data' => null,
                'status' => false,
                'message' => "",
                'error' =>  [__('messages.UNAUTHORISED')]
            ];
            return response($array, 401);
        }

        return $next($request);
    }
}
