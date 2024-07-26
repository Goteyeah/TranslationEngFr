<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{

    public function getLang(){
        return \App::getLocale();
    }

    public function setLang($lang){
        \Session::put('lang', $lang);
        dump($lang);
        return redirect()->back();
    }

}
