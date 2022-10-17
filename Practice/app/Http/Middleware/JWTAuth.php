<?php

namespace App\Http\Middleware;

use App\Exceptions\AppException;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
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
        }catch(TokenExpiredException $e){
            try
            {  
                return response()->data([
                        'access_token'=>  FacadesJWTAuth::parseToken()->refresh(),
                        'token_type'=>'bearer',
                        'expires_in'=>auth()->factory()->getTTL()*60
                    ],'Expired',2000);
                 
            }
            catch(TokenExpiredException $e){ 
                return response()->success('Token has been Expired.kindly login again',4001,false,401);
            }
            catch(TokenBlacklistedException $e){  
                return response()->success('Token has been BlackListed.kindly login again',4001,false,401);
            }
            catch(TokenInvalidException $e){ 
                return response()->success('Invalid Token.',4001,false,401);
            }
        }
        catch(TokenInvalidException $e){ 
            return response()->success('Invalid Token.',4001,false,401);
        }catch(TokenBlacklistedException $e){  
            return response()->success('Token has been BlackListed.kindly login again',4001,false,401);
        }
        catch(JWTException $e){
           
            return response()->success('Token Not found.kindly login again',4002,false,401);
        } 
        return $next($request);
    }
}
