<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DeptChair
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

        if (Auth::user()->sip) {
            return redirect()->route('/sip/home');
        }

        if (Auth::user()->deptChair) {
            return $next($request);
        }
    }
}
