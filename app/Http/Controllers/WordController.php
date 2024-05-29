<?php

namespace App\Http\Controllers;
use App\Models\Translation;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $words = Word::all();
        return view('words.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('words.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     //-------------------------------------
     //mettre validated data
     //-------------------------------------

        $injuresTab = ['vilain','mechant','pasbo']; //tableau tabou
       
                
        $injures = implode(',',$injuresTab); //les tabou en chaine de cararctère

        $validatedData = $request->validate([
           
           'words' => 'string|max:50|not_in:' . $injures, //'not_in' cest 'pas dedans' .le tableau implosé injure
        
                ]);




$word= new Word();

$word->isDictionary= $request->has('isDictionary'); // renvoi un booleen
$word->isValid = $request->has('isValid'); //renvoi un booleen
$word->fill($validatedData);

$word->save();
}  
    



       
     

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        $words = Word::all()->sortBy('words'); // récupère tous les mots colonne words et range par ordre alphabetique
        // dump($words[2]->translations); // recupère un tableau de traduction dans le mot word grace aux relation has many et belongto >>>> regarder eloquent orm
    $translations = Translation::all();
       
        return view('words.show', compact('words','translations'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $word=Word::find($id); // selection du mot grace à l'ID unique
        
        return view('words.edit', compact('word'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id) //  on récupère l'id en argument
    {
       
       $word = Word::findOrFail($id); //on selectionne bien le ID du mot qui vient de la methode "edit"
        
        $word->isValid= true;
        $word->isDictionary= true;
        $word->words = $request->input('motremplace'); // rentre dans cette variable la nouvelle valeur que je metterai dans words->words
        $word->save();
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        //
    }

  
}
