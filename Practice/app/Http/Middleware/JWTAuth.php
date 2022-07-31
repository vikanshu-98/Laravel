<?php

namespace App\Http\Middleware;

use App\Exceptions\AppException;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class JWTAuth
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
        try{ 
            $user = FacadesJWTAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if($e instanceof TokenExpiredException){ 
               // return response()->json(['d'=>FacadesJWTAuth::refresh()]);

                return response()->data([
                    'token'=>FacadesJWTAuth::parseToken()->refresh(),
                    'token_type'=>'bearer',
                    'expires_in'=>auth()->factory()->getTTL()*60
                ],'Expired');
             // throw new AppException('Token Expired',401); 
             
            
            }
            else if($e instanceof TokenInvalidException){ 
                throw new AppException('Token Invalid',401);
            }
            else{
                return response()->json(['success'=>false,'message'=>'Token Not Found'],401);
            }
        } 

        return $next($request);
    }
}
