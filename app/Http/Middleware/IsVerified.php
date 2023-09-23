<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class IsVerified
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is verified
        if (Auth::check() && Auth::user()->user_type == 'seller' && Auth::user()->seller->verification_status == 1) {
            return $next($request);
        }else{
            session(['link' => url()->current()]);
            return redirect()->route('seller.account_verification');
        }
    }
}
