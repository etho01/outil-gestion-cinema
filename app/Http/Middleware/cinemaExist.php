<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\cinema\Cinema;
use Illuminate\Support\Facades\Auth;

class cinemaExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->route()->cinema;
        $listCinema = Cinema::getCinemaByClient()->pluck('slug');
        if (!in_array($request->route()->cinema, $listCinema->all())){
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
