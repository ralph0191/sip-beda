<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Sip
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
        if (!Auth::check()) {
            return redirect()->route('/login');
        }
        
        if (Auth::user()->student) {
            return redirect()->route('/home');
        }

        if (Auth::user()->deptChair) {
            return redirect()->route('/dept-chair/home');
        }

        if (Auth::user()->sip) {
            return $next($request);
        }
    }
}
