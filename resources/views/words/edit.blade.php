<!-- jai utiliser route::post dans le fichier de route -->
<?php dump($word) ?>
<div>
    <!-- il faut utiliser le nom de la route ici cest word.update-->
<form method="POST" action="{{ route('word.update', $word->id ) }}"> <!-- ON MET LE WORD ID POUR LENVOYER AU CONTROLLEUR-->
<!-- PAGE 8 DU CHAPITRE ORGANISER AVEC LES CONTROLEURS-->
    @csrf
    
<!-- 
    @method('PATCH') -->

    <label for="motanglais">Mot en anglais</label>
    <input  name="motanglais" id="motanglais" type="text"
    value="{{ $word->words }}">

    <input name="cache" type="hidden"  value="{{$word->id}}">


    <label for="motremplace">mot de remplacement</label>
    <input type="text" name="motremplace" id="motremplace">
 
    <br>

    <label for="translation">Traduction potentielle du mot: </label>
    <input name="translation" id="translation" type="text"
    value="{{$word->translations}}">

    <br>

    <button type="submit" value="enregistrer">Enregistrer le mot anglais ou la truction</button>

    
</form>


</div>
