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
    
     // equivalant à ce quil y a dans le manager method getmovies du projet de thomas
           // ca recherche soit par title ( words dans ma bdd) soit par id

    function getWords(array $params = array()): LengthAwarePaginator
    {
        
     $query = word::select('id','words');
     
     if (isset($params['id']) && !empty($params['id']))
     {
         $query->where('id','=',$params['id']);
     }
     if (isset($params['title'])&& !empty($params['title']))
     {
         $query->where('words','like','%'.$params['title'].'%');

     }
     return $query->paginate(1)->withQueryString();// pagination, withQueryString ajoute les paramètres de la requete dans la barre d'adresse: regarder dans laravel doc dans le chapitre pagination, custom pagination
    }
     // equivalant à ce quil y a dans le manager method getmovies du projet de thomas
           // ca recherche soit par title ( words dans ma bdd) soit par id

           //fonction de classement
    function classement($query,int $ordo){
    
    if($ordo==1)
     {
        $query->orderBy('translation','asc');
        dump('passe par word dans la methode show');
     }
    elseif ($ordo == 3) 
     {
        $query->orderBy('created_at','desc'); //'desc' ordre inverse 
        dump('passe par word orderby');
    }
    elseif ($ordo==2) {

        $query->withCount('translations')->orderBy('translations_count','desc'); // récupère (get) le nombre de translation (withcount translation) par mot dans tructruc (trcutruc est une collection)
       // sur des collections on ne utilise pas -> mais on itère dans un foreach
        // le translations_count cest le nombre de translation par mot IMPORTANT
             
        }               
        
        return $words= $query->paginate(5)->withQueryString(); // pagination, withQueryString ajoute les paramètres de la requete dans la barre d'adresse: regarder dans laravel doc dans le chapitre pagination, custom pagination
    }
           //fonction de classement

    
   
    public function show(Translation $transDicos, word $finalsWords, request $request)
    {
        
    //    $ordo = $request->input('ordonner');
       $varvar = $request->input('varvar');
       $input = $request->all();
       $query = Translation::where('isDictionary',1);  
       $finalsWords = Word::where('translations->isDictionary',1);
        
           
           
           //equivalant à ce qu'il y a dans le controller movie search du projet de thoma
             
            // $recherche = $this->getWords($input); // on appelle la fonction getwords present a l'exterieur de show pour pouvoir la reutiliser dans show
            
           //equivalant à ce qu'il y a dans le controller movie search du projet de thoma
           //dans le manager
           // search controller backoffice/moviegenre ET manager movie/genre/manager


          $transDicos = $this->classement($query,1);

        return view('dictionary', compact('finalsWords'));
        
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
