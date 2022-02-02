<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\BlackListIp;
use Illuminate\Http\Request;
use App\Models\BlackListCountry;
use Facade\FlareClient\Http\Response;
use Stevebauman\Location\Facades\Location;

class BlackListMiddleware
{
    public $ip_adresses = [];
    public $countries = [];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ip_adresses = BlackListIp::pluck("ip")->toArray();
        $countries = BlackListCountry::pluck("country")->toArray();
        $user_location = Location::get($request->ip());
        if (in_array($request->ip(), $ip_adresses) || in_array(strtolower(is_bool($user_location) ? '' : $user_location->countryName), $countries)) {
            return response()->view('restriction-page');
        }
        return $next($request);
    }
}
