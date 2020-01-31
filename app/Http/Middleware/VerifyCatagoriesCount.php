<?php

namespace App\Http\Middleware;

use App\Catagory;
use Closure;

class VerifyCatagoriesCount
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
        if (Catagory::all()->count() == 0) {

            session()->flash('error', 'You need to add catagories to able to create a post');
            return redirect()->back();
        }
        return $next($request);
    }
}
