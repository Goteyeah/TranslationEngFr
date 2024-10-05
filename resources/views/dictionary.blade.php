
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')

  <title>Document</title>
</head>
<body>
  

<div>
<h1>Dictionnaire des mots avec leur traductions validés</h1>

<!-- message flash de success quand on ajoute un mot au dictionnaire -->

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- message flash de success quand on ajoute un mot au dictionnaire -->

<h2>classement</h2>
<form action="{{route('dictionary.show')}}">
  <label for="alphaorder">Ordre alphabétique</label>
  <input type='checkbox' name='ordonner' value="1">

  <label for="ordredate">par ordre de création</label>
  <input type="checkbox" name="ordonner" value="2">

  <label for="ordreetoile">par ordre de popularité</label>
  <input type="checkbox" name="ordonner" value="3">

  <button type="submit" >Ordonner</button>
</form>

<!-- fonctionalitée nombre mot par page dasn la pagination -->
<form method="get"  action="{{ route('dictionary.show')}}">
  @csrf
        <label for="varvar">Nombre mot par page</label>
    <input type="number" name="varvar" id="varvar" value="{{ request('varvar')}}">
<button type="submit" >soumettre</button>    
</form>
 <!-- fonctionalitée nombre mot par page dasn la pagination -->

 <!-- recherche equivalent view/movie/backoffice/partial/search form-->
 <form method="get"  action="{{ route('dictionary.show')}}">
 <div>
  <label for="id" class="form-label form-label-sm fw-bold fs-8">Rechercher par ID</label>
  <input type="text" class="form-control form-control-sm" name="id"
  value="{{ isset($input['id']) && !empty($input['id']) ? $input['id'] : '' }}">
</div>
<div>
<label for="title" class="form-label fw-bold fs-8" >TITLE TITLE TITLE</label>
<input type="text" class="form-control form-control-sm" name="title" 
value="{{ isset($input['title']) && !empty($input['title']) ? $input['title'] : '' }}">
</div>
@csrf
<button type="submit" value="search">chercher</button>
</form>

<!--  recherche equivalent view/movie/backoffice/partial/search form -->

@foreach($finalsWord as $finals)
<h1 >Mots traduits: <p class="bg-red-200 text-red-800 text-xl font-medium me-2 px-2.5 py-1.5 rounded-full dark:bg-red-200 dark:text-red-900 inline">{{$finals->words}}</p> Posté par: {{$finals->user->name}}</h1>
@foreach($finals->translations as $translation)
<p >Traduction associées:  <p 
class="text-xl px-3 bg-purple-200 text-purple-800 rounded-full inline">{{$translation->translation}} </p>Traduit par:<p class="text-xs  text-green-800 rounded" >{{$translation->user->name}}</p><p>
  @endforeach
@endforeach
<h3>{{$finalsWord->links()}}</h3>

</body>
</html>
