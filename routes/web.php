<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\TranslationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('start', function(){
    return view('start'); 

})->middleware(['auth', 'verified'])->name('start');// le middle ware permet d'obliger de se connecter avec le systeme de loggin breeze

Route::get('startB', function(){
    return view('startB'); 

})->middleware(['auth', 'verified']);

Route::get('startC', function(){
    return view('startC'); });

    Route::get('startD', function(){
        return view('startD');
    })->middleware(['auth','verified']);

    Route::get('index', function(){
        return view('index');
    })->middleware(['auth', 'verified']);

    Route::resource('word', WordController::class)->only([
        'index', 'create', 'store'
    ]);

    Route::resource('translation', TranslationController::class)->only([
        'index',  'store'
    ]);

    Route::get('translation/show', [TranslationController::class, 'show'])->name('translation.show');


    Route::get('translation/create',[TranslationController::class, 'create'])->name('translation.create');
   
   
    Route::get('translation/edit/{id}', [TranslationController::class,'edit'])->name('translation.edit');
    Route::post('translation/update/{id}', [TranslationController::class, 'update'])->name('translation.update'); // on signal {id} que lon va retrouver dans une methode du controller translationController SINON ca marche pas !
    
    Route::get('word/show',[WordController::class, 'show'])->name('word.show');
    Route::get('word/edit/{id}',[WordController::class, 'edit'])->name('word.edit'); //jai ecrit "/{id} pour que l'adresse dans la barre url soit plus propre il y aura l id juste après


    Route::post('word/update/{id}', [WordController::class, 'update'])->name('word.update'); //je nomme la route avec name pour lappeller dans les formulairesS