<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        
      
        if (!isset(auth()->user()->email)   && ($request->path() !='/login' && $request->path() !='/registration' )) {
            return redirect('/home')->with('error', 'You must have to be logged in');
        }
        if (isset(auth()->user()->email)  && ($request->path() == '/login' || $request->path() == '/registration' )) {
            return back();
        }
     
        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                              ->header('Pragma', 'no-cache')
                              ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
    }
}
