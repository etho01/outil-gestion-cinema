<?php

namespace App\Http\Middleware;

use App\Models\cinema\Cinema;
use Closure;
use App\Models\page\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class canGoPage
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
        $nomPage = $request->route()->action["as"];
        $PAGE = Page::getPageByNameRoute($nomPage);
        if(Page::pageExist($nomPage)){
            if($request->route()->cinema == null){
                $pageAuth = Auth::user()->getPageAutorized(NULL, false);
            } else {
                $pageAuth = Auth::user()->getPageAutorized(Cinema::getCinemaSlug($request->route()->cinema ), false);
            }
            //dd(!in_array($PAGE->id, $pageAuth->all()));
            if (!in_array($PAGE->id, $pageAuth->all())){
           //     return redirect()->route('dashboard');
            }
        }
        return $next($request);
    }
}
