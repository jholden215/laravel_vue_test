<?php

namespace App\Http\Middleware;
use Closure;
use Session;
use App\model\RoleMaster;
class CheckAuth
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
    	$token = $request->header('Authorization');
        if($token!="ABC123TOKEN")
        {
            return response()->json(['message'=>'Token Not Found']);
        }
        return $next($request);
    }
}
