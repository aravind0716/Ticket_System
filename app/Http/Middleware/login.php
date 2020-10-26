<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $email=$request->session()->get('email');
        if($email==NULL) {
            return view('login');
        }
        else{
            $response=$next($request);
            return $response;
        }
    }
}
