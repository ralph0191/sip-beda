<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class Student
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
        
        if (Auth::user()->sip) {
            return redirect()->route('/sip/home');
        }

        if (Auth::user()->role_id == 2) {
            return redirect()->route('home');
        }

        if (Auth::user()->student) {
            return $next($request);
        }
    }
}
