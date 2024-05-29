<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
<form method='POST' action="{{ route ('translation.store')}}">
     @csrf
    
   
     <!-- <label for="choisisLeMot">Quel mot voulez vous traduire ?</label>
    <input type="number" name="choisisLeMot" id="choisisLeMot"> -->

    <input name="cache" type="hidden" value="{{$id}}">

     <label for="traductionsForm">Traduction</label>
    <input type="text" name="traductionsForm" id="traductionsForm">
    
<label for="stars">ETOILES</label>
<input type="number" name="stars" id="stars">

    <input type="checkbox" name="isValid" id="isValid">
    <label for="isValid">Activer</label>
    
    <input type="checkbox" name="isDictionary" id="isDictionary">
    <label for="isDictionary">Activer</label>
    
<button type="submit"> ENREGISTRER </button>


</form>

</div>
