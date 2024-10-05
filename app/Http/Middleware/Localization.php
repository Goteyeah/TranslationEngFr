<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)
     */
    public function handle(Request $request, Closure $next): Response
    { 
       
        // Vérifier si la langue est définie dans la session
        if (Session::has('lang')) {
            // Récupérer la langue depuis la session et la définir
            App::setLocale(Session::get('lang'));
        }

       
        // if ( \Session::has('lang')) {
        //     // Récupération de la 'lang' dans Session et activation
        //     \App::setLocale(\Session::get('lang'));
        //     dump("je viens de terminer le middleware");
        // }
        return $next($request);
    }
}
