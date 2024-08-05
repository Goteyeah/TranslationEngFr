<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class dictionaryController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    
  // on positionne le methode getword à l'EXTERIEUR de show
// code pour la recherche de mot par id ou par mot( je peux faire plein d'autre type de recherche cest à regarder grace au projet de thomas dasn les managers controller et vue)  

function getWords(array $params = array()): LengthAwarePaginator
{
    $query = word::with(['translations','user']) 
    
        ->select('id','words','user_id');//selection des tables avec toutes leur collone dans cette requête
       
        // La clé étrangère user_id est nécessaire pour que Eloquent puisse faire correspondre les traductions avec les mots, et l auteur de la traduction et lauteur du mot posté.
                                
    if (isset($params['id']) && !empty($params['id'])){
        $query->where('id','=',$params['id']);
    } 
            
    if (isset($params['title']) && !empty($params['title'])){
        $query->where('words','like','%'.$params['title'].'%');
    }
    

    $result = $query->paginate(1)->withQueryString();

    if($result->isEmpty())
    {
        echo('Le mot est inexistant dans la base de données, postez le pour enrichir la base !');
    }
    return $result;
}
    // code pour la recherche de mot par id ou par mot( je peux faire plein d'autre type de recherche cest à regarder grace au projet de thomas dasn les managers controller et vue)  

// on positionne le methode getword à L'EXTERIEUR de show

           //fonction de classement
    function classement($query,int $ordo){
    
    if($ordo==1)
     {
        $query->orderBy('words','asc'); //query est une requête query builder et non une collection eloquent
     }
    elseif ($ordo == 2) 
     {
        $query->orderBy('created_at','desc'); //'desc' ordre inverse 
        dump('dans dictionary par word orderby');
    }
    elseif ($ordo==3) 
    {

        $query->withCount('translations')->orderBy('translations_count','desc'); // récupère (get) le nombre de translation (withcount translation) par mot dans tructruc (trcutruc est une collection)
       // sur des collections on ne utilise pas -> mais on itère dans un foreach
        // le translations_count cest le nombre de translation par mot IMPORTANT
             
        }               
        
        return $words= $query->paginate(2)->withQueryString(); // pagination, withQueryString ajoute les paramètres de la requete dans la barre d'adresse: regarder dans laravel doc dans le chapitre pagination, custom pagination
    }
           //fonction de classement

    
   
    public function show( request $request)
    {
       $ordo=($request->input('ordonner') ?? 1); //operateur de coalescence
       $input = $request->all();
       
       $transDicti = Translation::where('isDictionary',1)->get();  
       $finalsWords = Word::whereHas('translations', function($query) //selectionne les mots avec des translations isdicionary=1
       {
        $query->where('isDictionary',1);
       });

       $finalsWord= $this->classement($finalsWords, $ordo);
               
        return view('dictionary', compact('finalsWord','transDicti'));
        
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $translation = Translation::findOrFail($id);
        $translation->isDictionary = 1;
        $translation->save();
        $finalsWords = Word::where('translations->isDictionary',1);
        return redirect()->route('dictionary.show')->with('success','Vous avez rajouté le mot au dictionaire !');//message flash qui se met dans session

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $wordDict = word::findOrFail($id);
        $supprimer = $wordDict->translations; //supprime les traduction associé a l id du mot
       
        foreach($supprimer as $supr)
        {
            $supr->delete(); // supprime la traduc du dictionaire et de la bdd tout court
        }

        $wordDict->delete(); //supprime le mot du dictionaire et de la bdd tout court
        
        // $supr->translation->delete();
       
        //
    }
}
