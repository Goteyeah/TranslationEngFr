<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body class="bg-[url('/public/background.jpg')]  bg-cover bg-center h-screen">

       
@if(session('status'))
    <div class="max-w-lg mx-auto mt-4 p-4 rounded-lg text-white
        {{ session('status') === 'Utilisateur bloqué.' ? 'bg-red-500' : 'bg-green-500' }}">
     {{ session('status') }}
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
<!--  -->

<div class="ring-2 ring-blue-500">
<h1>Liste des comptes utilisateurs et de leur section correspondante</h1><br>

@foreach($listeSection as $section) <!--ATTENTION le listeSection vient de la methode create du controller section-->
<div>
{{$section->name}}
  </div>
@foreach($section->user as $users)
{{$users->surname}}<a href="{{route('user.update',['id'=>$users->id, 'value'=>1]) }}"> bloquer l'utilisateur</a>
<a href="{{route('user.update',['id'=>$users->id, 'value'=>2]) }}">debloquer l'utilisateur</a>
<h2>Est bloqué ? {{$users->blocked}}</h2>

@endforeach
<br>
@endforeach
</div>
</body>
</html>