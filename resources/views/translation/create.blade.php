<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
<form method='POST' action="{{ route ('translation.store')}}">
     @csrf
    
   
     <!-- <label for="choisisLeMot">Quel mot voulez vous traduire ?</label>
    <input type="number" name="choisisLeMot" id="choisisLeMot"> -->

<!-- si il y a la moindre erreur dans la validation des données-->

@if ($errors->any()) 
    <ul id="errors">
        @foreach( $errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
        </ul>
        @endif

<!-- si il y a la moindre erreur dans la validation des données-->

    <input name="cache" type="hidden" value="{{$id}}">
<h1>
    <h1 style='color: red;'> Proposer une traduction pour le mot: {{$WordTranslate->words}}</h1>
     <label for="traductionsForm">Traduction</label>
    <input type="text" name="traductionsForm" id="traductionsForm">
</h1>    

<button type="submit"> ENREGISTRER </button>


</form>

</div>
