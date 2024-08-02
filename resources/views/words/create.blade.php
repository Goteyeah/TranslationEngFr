<h5>CREATION DUN MOT</h5>


<!-- creation d'un mot grace au formulaire form -->
<form method='POST' action="{{ route ('word.store')}}">
     @csrf
    

<!-- si il y a la moindre erreur dans la validation des données-->

@if ($errors->any()) 
    <ul id="errors">
        @foreach( $errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
        </ul>
        @endif

<!-- si il y a la moindre erreur dans la validation des données-->
        
     <input name="words" 
     type="text"
     id="word"
     placeholder="Mot anglais"
     value="{{old('word')}}" />

     <input type="checkbox" name="isValid" id="isValid">
    <label for="isValid">Activer</label>
    @csrf
<button type="submit"> ENREGISTRER </button>


</form>