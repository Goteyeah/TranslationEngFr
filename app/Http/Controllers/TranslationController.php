<?php

namespace App\Http\Controllers;
use App\Models\Translation;
use App\Models\Word;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\collection;
use Carbon\Carbon;

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
        $WordTranslate = Word::findOrFail($id); 

       return view ('translation.create', compact('id','WordTranslate')); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    //-------------------------------------
    
$validatedData = $request->validate([ 
    
    'cache' => 'required|integer', // les champs requis dont le champs 'cache' qui contient l id du mot a traduire
    'traductionsForm' => 'required|string|max:50|alpha', // la traduction ne contient que des lettres ( rule: alpha)
]);

$Mot = Word::find($request->input('cache')); // je cherche le mot d'id "cache" ( qui vient du formulaire)
$traduc = new Translation; //creer une instance de translation
$traduc->translation = $validatedData['traductionsForm']; // je rempli $traduc avec des valeurs validées grace au formualire

$traduc->user_id = Auth::id();
$Mot->translations()->save($traduc);// je sauvegarde $traduc dans le mot



// redirection et message
return redirect()
    ->action([WordController::class, 'show'])// redirection vers la route word show
    ->with('message', 'la traduction de '. $traduc->translation . ' pour le mot '.$Mot->words .' est enregistrée'); //message de succes transmi à la vue show
// redirection et message

    }

    /**
     * Display the specified resource.
     */
    public function show(Translation $translations, Word $word)
    {
       $translations = Translation::all(); 
        

       
       return view('words.show', compact('translations','userStar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(request $request,int $id)
    {
        
        $translation = Translation::find($id);
      


        return view('translation.edit', compact('translation'));
        
        //
    }

    /**
     * Update the specified resource in storage.
     */
//ETOILES methode
     function addStar(Translation $translation)
     {
           
     $userStar = User::findOrFail(auth::id());
     
     $userStar->stars = $userStar->stars - 1; // nombre etoile - 1 pour l'utilisateurn
     $translation->stars = $translation->stars + 1; // nombre etoile + 1 pour la traduction
     $userStar->save();
     $translation->save();
    
     return $userStar;
    
     }
     //ETOILES methode
     
     // compte et decompte avec carbon des etoiles par utilisateur

    function restartStars(User $userNbStars)
    {
       
        $starsDate = Carbon::parse($userNbStars->starsDate); //on transforme cette date en instance carbon
        $time = now(); // date actuel jour mois année

        if  ($starsDate->diffInDays($time) > 7 ) // si la différence jour entre les deux dates carbon inferieure à 7 jours
        {   
            $userNbStars->stars = 7; // nouvelle solde d'etoiles de 7
            $userNbStars->starsDate = now(); //on change l'ancienne date par aujourdhui
            $userNbStars->save();
        } 
       
        $dateRemain = $starsDate->addDays(7);

        return $dateRemain;
    }

    // compte et decompte avec carbon des etoiles par utilisateur

    
    
     public function update(Request $request, int $id) // int id  correspond au {id} de la route update
    {     
   
        $translation = Translation::findOrFail($id); // findorfail est une methode static
        
        if($request->input('stars'))
        {
            $userStar = $this->addStar($translation);//appelle de la methode addStar  ( juste au dessus de la methode update)
        }
        
        $ancienneTr = $translation->translation;
        $newTranslation =  $request->input('varNewTrans');
        $translation->translation = $newTranslation;
        
        if ($translation->translation == null)
        {   // si pas de nouvelle traduction on garde l'ancienne
            $translation->translation= $ancienneTr;
        }
       dump($translation->translation);
        
       if($request->input('stars'))
       {
        $dateRemain = $this->restartStars($userStar); //appelle de la methode restartStars ( juste au dessus de la methode update)
       }

        if ( $translation->isDirty()) {
            $translation->save(); //message flash vers la vue show word
            $messageChange = 'Vous avez changé la traduction en : '.$translation->translation; // syntaxe de concaténation en php
            // return view('words.show');
            
         }
          
     
//s occupe de la fonction dictionaire
    //récupère le mot par la traduction associé
if ($request->input('isDictionary')==true)
{
$motop = $translation->word_id;
dump($motop);
$motpo = word::findOrFail($motop);
$translation->isDictionary = true;
$motpo->isDictionary = true;
};
//récupère le mot par la traduction associé


return redirect()->route('word.show')
    ->with('userStar', $userStar ?? null) // userStar ?? null signifie que si $userStar est défini et n'est pas null, alors $userStar sera utilisé ; sinon, null sera utilisé.
    ->with('dateRemain',$dateRemain ?? null) //dateRemain ?? null signifie que si $dateRemain est défini et n'est pas null, alors $dateRemain sera utilisé ; sinon, null sera utilisé.
    ->with('message', $messageChange ?? null); // le ?? est un opérateur de coalescence
    
//s occupe de la fonction dictionaire   

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
