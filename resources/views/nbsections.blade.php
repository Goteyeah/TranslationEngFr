<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @if(session('status'))
        <div class="alert {{ session('status.error') ? 'alert-danger' : 'alert-success' }}">
            {{ session('status.message') }}
        </div>
    @endif
    
    @if ($errors->any())
    @foreach($errors->all() as $errors)
    <h1>{{$errors}}</h1>
    @endforeach
    @endif

    <h1>Nouvelle section</h1>    
    <form method="POST" action="{{ route('section.store') }}" >
    @csrf
    <!-- tableau de sections + nombre de section -->
    <label for="tabSections">Créer une nouvelle section</label>
    <input type="text" name="tabSections" id="tabSections" placeholder='nouvelle section'>
        
        <button type="submit">ok</button>
     
</form>



<h1>Liste des comptes utilisateurs et de leur section correspondante</h1>

@foreach($listeSection as $section) <!--ATTENTION le listeSection vient de la methode create du controller section-->
<div>
{{$section->name}}
  </div>
@foreach($section->user as $users)
<h2>{{$users->surname}}<a href="{{route('user.update',['id'=>$users->id]) }}">bloquer l'utilisateur</a><h2>Est bloqué ? {{$users->blocked}}</h2></h2>
@endforeach
<br>
@endforeach

</body>
</html>