<?php

namespace App\Http\Controllers;
use App\Models\Translation;
use App\Models\Word;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $id=$request->query('id'); //important >> prend le champ query donc l'id du mot que je donne au formulaire dans l input caché ( "cache")
    

       
       return view ('translation.create', compact('id')); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    //-------------------------------------
     //mettre validated data
     //-------------------------------------
 
$Mot = Word::find($request->input('cache')); // je cherche le mot d'id "cache" ( qui vient du formulaire)
$traduc = new Translation; //creer une instance de translation
$traduc->translation = $request->input('traductionsForm'); // je rempli $traduc grace au formualire
$Mot->translations()->save($traduc);// je sauvegarde $traduc dans le mot
dd($Mot);


$traductionMot->translation = $request->input('traductionsForm'); // la traduction entrée au clavier à partir du formulaire le champ "traductionsForm"

$traductionMot->isDictionary= $request->has('isDictionary');
$traductionMot->isValid = $request->has('isValid');
$traductionMot->stars = $request->input('stars');

$traductionMot->save(); 

$Mot->translations()->save($traductionMot); // sauvegarde des entrees appelle la method translation du modèle WORD
 
    }

    /**
     * Display the specified resource.
     */
    public function show(Translation $translations)
    {
       $translations = Translation::all(); 
       return view('translation.show', compact('translations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        
        $translation = Translation::find($id);
       
        
        return view('translation.edit', compact('translation'));
        
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id) // int id  correspond au {id} de la route update
    {
        
        $translation = Translation::findOrFail($id); // findorfail est une methode static
        
        $translation->translation = $request->input('varNewTrans');
       
        $translation->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
