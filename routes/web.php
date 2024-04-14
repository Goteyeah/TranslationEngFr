<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/acceuil', function () {
    return view('acceuil');
});


// route du formulaire de recherche

Route::get('/sidebar', function () {
    return view('sidebar');

});

// route barre de recherche

Route::get('/search' , [postController::class, 'search']);
