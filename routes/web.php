<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\dictionaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\LocalizationController;

use Illuminate\Support\Facades\App;
use App\Http\Middleware\Localization;



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
    });

    Route::get('index', function(){
        return view('index');
    })->middleware(['auth', 'verified']);

    Route::resource('word', WordController::class)->only([
        'index', 'create', 'store'
    ])->middleware(['auth', 'verified']); // grace au middleware permet de donner l acces a cette route uniquement si lutilisateur est logger

    Route::resource('translation', TranslationController::class)->only([
        'index',  'store'
    ]);

    Route::get('translation/show', [TranslationController::class, 'show'])->name('translation.show');


    // Route::get('translation/create',[TranslationController::class, 'create'])->middleware(['auth', 'verified'])->name('translation.create');
    Route::get('translation/create',[TranslationController::class, 'create'])->name('translation.create');

   
    Route::get('translation/edit/{id}', [TranslationController::class,'edit'])->name('translation.edit');
    Route::post('translation/update/{id}', [TranslationController::class, 'update'])->name('translation.update'); // on signal {id} que lon va retrouver dans une methode du controller translationController SINON ca marche pas !
    
    Route::get('word/show',[WordController::class, 'show'])->name('word.show');
    Route::get('word/edit/{id}',[WordController::class, 'edit'])->name('word.edit'); //jai ecrit "/{id} pour que l'adresse dans la barre url soit plus propre il y aura l id juste après

    Route::post('word/update/{id}', [WordController::class, 'update'])->name('word.update'); //je nomme la route avec name pour lappeller dans les formulairesS

    Route::get('dictionary', [dictionaryController::class, 'show'])->name('dictionary.show');
    Route::get('dictionary/update/{id}', [dictionaryController::class, 'update'])->name('dictionary.update');

    Route::get('sectionliste', [UserController::class, 'show'])->name('sectionListe.show');
    Route::get('dictionary/delete/{id}', [dictionaryController::class, 'destroy'])->name('word.dict.delete'); // route de suppression de mot du dictionaire
    Route::get('section', [sectionController::class, 'create'])->name('section.create');
    Route::post('section/store', [sectionController::class, 'store'])->name('section.store');
    Route::post('section/delete/{id}', [SectionController::class,'destroy'])->name('section.delete'); // appel la methode "destroy" du controller "sectioncontroller"
    Route::get('user/delete/{id}', [UserController::class,'destroy'])->name('user.delete');

    //j'ai creer un middleware pour changer la langue
//    Route::get('locale',[LocalizationController::class,'getLang'])->name('getlang'); //connaitre la langue active
   
//    Route::get('locale/{lang}',[LocalizationController::class,'setLang'])->name('setlang'); // va changer la langue par default on appel le middleware localization et on utilise la variable de session
   //j'ai creer un middleware pour changer la langue
   Route::get('section/update/{id}',[UserController::class,'update'])->name('user.update');

   