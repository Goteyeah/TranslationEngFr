<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Section;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        dump("ici lalalallalllalalalalalalaallalalalala");
        $tabSection = Section::all();
        return view('auth.register',compact('tabSection'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            //ajouté
            'surname' => ['required','string','max:255'],
            'genre' => ['required','boolean'],
            // 'section' => ['string'],
            //ajouté
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'section_id' => ['nullable','exists:sections,id'],
            // 'post_words' => ['nullable','string'], // champ string en possibilité NULL ( allé a la migration USER)
            // 'post_translations'=> ['nullable','string'], // champ string en possibilité NULL ( allé à la migration USER)
        ]);

        

        $user = User::create([
            'name' => $request->name,
            //ajouté
            'surname'=>$request->surname,
            'genre' => $request->genre, // genre sera le resultat boolean des bouton radio
            // 'section' => $request->section, //section sera l'option choisi , les options du menu deroulant sont le tableau de section
            //ajouté
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
            //rajouté mais en cour de taf mais ne fonctionne pas
            'section_id' => $request->input('sections'), // section_id , lien utilisateur appartient a une section
              //rajouté mais en cour de taf
              dump( $request->input('sections')),

        ]);
// on affecte à sections_id l'id corrspondant à la section recupéré dasn le formulaire dans le composant tableau sections contenu dans registrer

 $user->section_id = $request->input('sections');
 $user->save();
 // on affecte à sections_id l'id corrspondant à la section recupéré dasn le formulaire dans le composant tableau sections contenu dans registrer

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
