<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
.hidden{
    display: none;
}
</style>
<body>
    
<h1>titre de ma page html foreach</h1>
<div>
    <form action="{{ route('word.show') }}">
    <label for="ordonner">Ordonner</label>
    <button type='checkbox' name='ordonner'>classer par ordre alphabétique ou par date d'ajout.</button>
    </form>
    
    <!-- j'itère sur l'objet word pour chaque items extrait "words" de la table dans la  bdd-->
    @foreach($words as $word) 
    <div>
    <p id="isValid">nom: <a href="{{ route('word.edit', ['id'=>$word->id])}}">mot : {{$word->words}} numero {{$word->id}}</a></p>  <!-- je creer des liens avec la methode url que je mes dans href de la balise html <a>-->
    <!-- j'itère sur l'objet word et je 'extrait le champ "translations" de la table quand il y en a un-->
    
    
<br>

    <p>translation : <a href="{{route('translation.edit', ['id'=>$word->id])}}">{{$word->translations}}</a></p>
   
    
    <p><a href="{{route('translation.create',['id'=>$word->id])}}">Créer une traduction pour {{$word->translations}}</a></p>
       <!-- on route bien sur "translation.edit" !!! -->
    @endforeach
    <div>
    
    @foreach($translations as $translation)
    <a href="">traduction:{{$translation->translation}} id {{$translation->word_id}}</a>
    <br>
    @endforeach
</div>


    
</div>
</body>
</html>

    

