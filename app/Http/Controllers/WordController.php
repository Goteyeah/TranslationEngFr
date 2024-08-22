<?php

namespace App\Http\Controllers;
use App\Models\Translation;
use App\Models\Word;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;

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

        $injuresTab = ['vilain','mechant','pasbo']; //tableau de mots tabous

        $injures = implode(',',$injuresTab); //les tabou en chaine de caractères

        $validatedData = $request->validate([
           
           'words' => 'unique:words,words|alpha|required|string|max:50|not_in:' . $injures, //'not_in' cest 'pas dedans' .le tableau implosé injure,// unique >> nest pas déja dans la bdd
         
                ]);

                

$word= new Word();
$word->user_id= auth::id(); //rempli la colonne avec l id de la personne connectée courante
$word->isDictionary= $request->has('isDictionary'); // renvoi un booleen
$word->isValid = $request->has('isValid'); //renvoi un booleen
$word->fill($validatedData);
//jajoute pour le classement etoile
$word->save();



//redirection et message de succès avec entre les "." le mot
return redirect()
->action([WordController::class, 'show'])//redirection
->with('message', 'Mot ' . $word->words .' créer et enregistré' )//message de succes transmi à la vue show avec la variable words entre les "."
->withInput();

//redirection et message de succès avec entre les "." le mot


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
            
                if (isset($params['translation']) && !empty($params['translation'])){
                    $query->whereHas('translations', function ($subQuery) use ($params) { //fonction anonyme (closure)// il y a des mots sans traductions
                        $subQuery->where('translation', 'like', '%' . $params['translation'] . '%');
                    });
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
// je positionne la methode de classement a l'exterieur de la methode show
function classement($query,int $ordo){
    
    
    if($ordo==1)
     {
        $query->orderBy('words','asc');
        dump('passe par word dans la methode show');
     }
     elseif ($ordo == 3) 
     {
        $query->orderBy('created_at','desc'); //'desc' ordre inverse 
        
    }
    elseif ($ordo==2) {

        $query->withCount('translations')->orderBy('translations_count','desc'); // récupère (get) le nombre de translation (withcount translation) par mot dans tructruc (trcutruc est une collection)
       // sur des collections on ne utilise pas -> mais on itère dans un foreach
        // le translations_count cest le nombre de translation par mot IMPORTANT
             
        }               
        
        return $words= $query->paginate(5)->withQueryString(); // pagination, withQueryString ajoute les paramètres de la requete dans la barre d'adresse: regarder dans laravel doc dans le chapitre pagination, custom pagination
    }
// je positionne la methode de classement a l'exterieur de la methode show

    /**
     * Display the specified resource.
     */
    public function show(Word $word, Request $request)
    {
        $varvar = $request->input('varvar');
        $ordo = $request->input('ordonner');
        $letter = $request->input('letter'); // récupère la valeur dans une lettre de l'alphabet dans ['letter'=>$letter ] et PAS d'un name='letter', 
        $input = $request->all();
        $query =Word::query(); //pourquoi query et pas all: car on travail directement sur des requêtes sql sans utiliser les modèles eloquants
        
        

      
        // recherche des mot par la première lettre
       
        $words=  Word::where('words','REGEXP','^'.$letter)->paginate($varvar); //expression régulière '^' pour commence par dans une string
            
        // recherche des mot par la première lettre

        $rechercheWord = $this->getWords($input);  // On met this pour appeller la methode qui est a l 'exterieur de show mais dans le controller wordS
       
     
        if($ordo)
        {
             $words= $this->classement($query, $ordo);
        }
    
       return view('words.show', compact('words','rechercheWord'));
        
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
        
    return redirect()
    ->action([WordController::class ,'show'])
    ->with('message','mot modifié en:'.$word->words.'');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $wordTra = word::findOrFail($id);
        $wordTra->delete();
        

    }

    
}
