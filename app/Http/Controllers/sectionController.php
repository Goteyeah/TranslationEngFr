<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


class sectionController extends Controller
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

        $listeSection = section::all();
        return view('nbsections', compact('listeSection'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
           
            'tabSections' => 'string|required|max:50|alpha'
          
                 ]);

        $listeDeSections = new section();
        $listeDeSections->name = $validatedData['tabSections'];
        $listeDeSections->save();
        
    
                 if($listeDeSections){
                    session()->flash('status',['error'=>false,'message'=>'Section ajoutée avec succès !']);
                   
                 } else // les message flash s'affiche sur la vue nbsections mais le tabsection se retourne à la vue registrer car cest enregistré dans la bdd
                 {
                    session()->flash('status',['error'=>true, 'message'=>'Section non ajoutée.']);
                 }
       
      
$tabSection = Section::all(); // on prend TOUTE la collection et on iterera sur le champ section de ma table section

    return redirect()
    ->action([SectionController::class,'create']); //ATTENTION ne fonctionne pas avec return view sinon ca me redirige vers la method store.
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update()
    {
  // test de modif de langue
// $langue = App::getLocale();
//         dump($langue);
//         App::setLocale('fr');
//         $langueFr = App::getLocale();
//         dump($langueFr);
//         return view('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $section = section::findOrFail($id);
        $section->delete();
    }

    
    public function nombreSection(request $request){
       

}
}
