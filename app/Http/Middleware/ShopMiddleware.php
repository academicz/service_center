<?php

namespace App\Http\Middleware;

use App\Constants\Constants;
use App\Models\ServiceCenter;
use Closure;
use Illuminate\Support\Facades\Auth;

class ShopMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == Constants::$SERVICE_CENTER_USER) {
            if (ServiceCenter::findOrFail(Auth::user()->user_id)->status == Constants::$APPROVED_CENTER) {
                return $next($request);
            }
            return redirect()->route('getShopLogin')->with(['error' => 'Your registration must approved before login']);
        }
        return redirect()->route('getShopLogin')->with(['error' => 'You must login first']);
    }
}
