<h5>CREATION DUN MOT</h5>


<!-- creation d'un mot grace au formulaire form -->
<form method='POST' action="{{ route ('word.store')}}">
     @csrf
    
     <input name="words" 
     type="text"
     id="word"
     placeholder="word en question" />

     <input type="checkbox" name="isValid" id="isValid">
    <label for="isValid">Activer</label>
    
    <input type="checkbox" name="isDictionary" id="isDictionary">
    <label for="isDictionary">Activer</label>
    
<button type="submit"> ENREGISTRER </button>


</form>