<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>Document</title>
</head>


<body>
    <!-- //message flash -->
    <h1 style='color: yellow;'>@if (session('message'))
    <div class='alert'>{{session('message')}}
    </div>
    @endif
</h1>
    <!-- message flash -->



 <!-- l alphabet de a à z -->
 @foreach (range('A','Z') as $letter) <!-- les lettres de A à Z-->
   
 <h1 style="display: inline;"><a href="{{ route('word.show',['letter'=>$letter]) }}">{{$letter}}</a></h1> <!-- clefs égales aux valeur ( 'A'=>'A') etc-->
    
 @endforeach
         <!-- l alphabet de a à z -->

<h1><a href="{{ route('word.create')}}">+ Nouveau mot anglais</a></h1>

<div style='background-color: yellow;'>
    @if(session('userStar'))
        <h3>Il vous reste: {{session('userStar')->stars}} etoiles jusqu'au</h3>
    @endif
    @if(session('dateRemain'))
        <h3>{{session('dateRemain')}}</h3>
@endif
</div>

<!-- tri                 tri-->
<h1>Liste de mots et traduction</h1>
<div>
    <form action="{{ route('word.show') }}">
    <label for="ordonner">Classement par nombre alphabétique</label>
    <input type='checkbox' name='ordonner' value="1">
    
    <label for="ordonnerNbTraduc">Classement par nombre de traductions</label>
    <input type='checkbox' name='ordonner' value='2'>
    
    <label for="ordonnerDateCrea">Classement par date de création</label>
    <input type='checkbox' name='ordonner' value="3">
    <br>
       <button type="submit">classer</button>
    </form>
    <!-- tri            tri-->
      


    
<!-- fonctionalitée nombre mot par page dasn la pagination -->
<form method="get"  action="{{ route('word.show')}}">
        <label for="varvar">Nombre mot par page</label>
    <input type="number" name="varvar" id="varvar" value="{{ request('varvar')}}">
<button type="submit" >soumettre</button>    
</form>
 <!-- fonctionalitée nombre mot par page dasn la pagination -->

 <!-- fonction de recherche equivalent a view/movie/backoffice/partial/search form dans le projet de thomas-->
 <form method="get"  action="{{ route('word.show')}}">
<div>
    <label for="id" class="form-label form-label-sm fw-bold fs-8">Rechercher un mot par son numero</label>
    <input type="text" class="form-control form-control-sm" name="id"
value="{{ isset($input['id']) && !empty($input['id']) ? $input['id'] : '' }}">
</div>


      <!-- premiere skin css pour la barre de recherche POUR LINSTANT ELLE CHERCHE PAR MOT-->
      <div class="min-h-screen bg-gray-100 flex justify-center items-center px-20">
  <div class="space-y-10">
    <h1 class="text-center mt-10 text-4xl font-bold">Create By Joker Banny</h1>
    <div class="flex items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
      <div class="flex bg-gray-100 p-4 w-72 space-x-4 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input name="title" class="bg-gray-100 outline-none" type="text" placeholder="Article name or keyword..." 
        value="{{ isset($input['title']) && !empty($input['title']) ? $input['title'] : '' }}"/>
      </div>
      <div class="flex py-3 px-4 rounded-lg text-gray-500 font-semibold cursor-pointer">
      
      <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Dropdown button <svg class="w-4 h-4 ms-3 text-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
</svg>
</button>

<!-- skin TW pour le dropdown bleu jai changer la taille du text de 'sm' en 'lg'-->
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-lg text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
      </li>
    </ul>
</div>

      </div>
      <div class="bg-red-600 py-3 px-5 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
        <span>    <button type="submit" value="search">chercher</button>
        </span>
      </div>
    </div>

   <!-- skin TW pour le dropdown bleu jai changer la taille du text de 'sm' en 'lg'-->


<div>
    <label for="translation" class="form-label fw-bold fs-8" >Rechercher une traduction</label>
    <input type="text" class="form-control form-control-sm" name="translation" 
    value="{{ isset($input['translation']) && !empty($input['translation']) ? $input['translation'] : '' }}">
</div>

    <button type="submit" value="search">chercher</button>
</form>

<div style='color: red;'>
  @foreach ($rechercheWord as $truc)
    <h2 >Mot: {{ $truc->words}} Mot posté par : {{$truc->user->name}}
    <br> @foreach($truc->translations as $translation)<h2 > traduction proposées :{{$translation->translation}} par {{$translation->user->surname}} </h2>
       @endforeach
  @endforeach
</div>

 <!-- fonction de recherche equivalent a view/movie/backoffice/partial/search form dans le projet de thomas-->


  <!--les pages paginées de la collection $words -->
   <h3>{{ $words->links() }}</h3>
 

    <!-- j'itère sur l'objet word pour chaque items extrait "words" de la table dans la  bdd-->
    
    @foreach($words as $word) 

<!-- je cache -->

<div class="text-xl px-2 bg-green-200 text-green-800 rounded-full" >
    <a  href="{{ route('word.edit', ['id'=>$word->id])}}" >mot : {{$word->words}} numero {{$word->id}}</a> <br>  <!-- je creer des liens avec la methode url que je mes dans href de la balise html <a>-->
 <!-- fonctionalitée cacher pour word->isdictionary je dois le mettre pour translation->isdictionary --> 
</div>
    <!-- j'itère sur l'objet word et je 'extrait le champ "translations" de la table quand il y en a un-->
    <!-- badge de couleur -->
    <div style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-xl px-3 bg-purple-200 text-purple-800 rounded-full">   
    <!-- badge de couleur -->
    <a   href="{{route('translation.create',['id'=>$word->id])}}">Créer une traduction pour {{$word->words}}</a>  <br>   
</div>
    @foreach($word->translations as $translation)
    <div  style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-sm px-3 bg-blue-200 text-blue-800 rounded-full">    
    <a  href="{{route('translation.edit', ['id'=>$translation->id])}}">Traduction : {{$translation->translation}}</a>
    </div>
    
 
    <!-- etoiles --><div style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-xxl px-3 bg-yellow-200 text-yellow-800 rounded-full">
        <p>Nombre d'étoiles: {{$translation->stars}}</p>
</div>

<div style="padding-top: 0.2em; padding-bottom: 0.2rem" class="flex items-center space-x-1 text-sm px-2 bg-gray-200 text-gray-800 rounded-full">
                <div style="width: 0.4rem; height: 0.4rem" class="bg-gray-500 rounded-full"></div>
        <a href="{{route('dictionary.update', ['id'=>$translation->id])}}">Ajouter au dictionnaire</a>
</div>
    <form method="POST" action="{{ route('translation.update', ['id'=>$translation->id]) }}">
    @csrf

    <div style="padding-top: 0.2em; padding-bottom: 0.2rem" class="flex items-center space-x-1 text-sm px-2 bg-gray-200 text-gray-800 rounded-full">
    <div style="width: 0.4rem; height: 0.4rem" ></div>
    <!-- etoile-->
    <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 w-5 h-auto fill-current hover:text-yellow-600"
            viewBox="0 0 16 16">
            <path
                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
        </svg>
        <!-- étoile -->
    <button type="submit" name="stars" value="1">Ajouter une étoile</button>
</div>
    <!-- etoiles -->


        </form>

<p>Traduit par: {{$translation->user->name}}</p>

    @endforeach
     <p>Auteur du Mot demandé {{\App\Models\User::find($word->user_id)->name}}</p>
     <br>
    @endforeach
                                                                            
    <div>      
</div>

</div>

<script src="{{asset('/test.js')}}"></script>



    

