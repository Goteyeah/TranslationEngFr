<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<div>
    <label for="title" class="form-label fw-bold fs-8" >Rechercher un mot</label>
    <input type="text" class="form-control form-control-sm" name="title" 
    value="{{ isset($input['title']) && !empty($input['title']) ? $input['title'] : '' }}">
</div>
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


    <p>nom: <a  href="{{ route('word.edit', ['id'=>$word->id])}}" ><h1  >mot : {{$word->words}} numero {{$word->id}}</h1></a></p>  <!-- je creer des liens avec la methode url que je mes dans href de la balise html <a>-->
 <!-- fonctionalitée cacher pour word->isdictionary je dois le mettre pour translation->isdictionary --> 

    <!-- j'itère sur l'objet word et je 'extrait le champ "translations" de la table quand il y en a un-->
       <p><a href="{{route('translation.create',['id'=>$word->id])}}">Créer une traduction pour {{$word->words}}</a></p>     

    @foreach($word->translations as $translation)
        <p>traduction : <a href="{{route('translation.edit', ['id'=>$translation->id])}}">{{$translation->translation}}</a></p>
    
    
 
    <!-- etoiles -->
        <p>{{$translation->stars}}</p>
       

        <p><a href="{{route('dictionary.update', ['id'=>$translation->id])}}">Ajouter au dictionnaire</a></p>

    <form method="POST" action="{{ route('translation.update', ['id'=>$translation->id]) }}">
    @csrf

    <button type="submit" name="stars" value="1">Ajouter une étoile</button>
    
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
<div>


    

