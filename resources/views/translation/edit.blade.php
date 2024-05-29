<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formulaire de changement de traduction</h1>
    <div>
        <form method="POST" action="{{ route('translation.update', $translation->id) }}">
@csrf

<label for="ancienMot">traduction actuel</label>
<h1>{{$translation->translation}}</h1>

<input name='cache' type="hidden" value="{{$translation->id}}">

<label for="varNewTrans">Mot/traduction de remplacement</label>
<input name="varNewTrans" id="varNewTrans" type="text">

<input type="checkbox" name="valeurTestA">
<input type="checkbox" name='valeurTestB'>

<button type="submit" value="enregistrer">SAUVEGARDER</button>

        </form>
    </div>
</body>
</html>