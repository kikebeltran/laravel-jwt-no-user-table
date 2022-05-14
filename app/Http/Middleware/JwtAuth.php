<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Http\CustomRequest;
use Illuminate\Http\Request;



class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle( Request $request, Closure $next)
    {

        $requestToken = $request->header('Authorization');
        $key = env('JWT_SECRET');
        $token = explode(' ', $requestToken);
        try{
            $decoded = JWT::decode( $token[1], new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $user = new User();
        $user->id = $decoded->sub;

        $user->setRows( [ $user ] );
        
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        // $request->user = $user;
        
        return $next($request);
    }
}
