<h1>titre du foreach pour ls traductions</h1>

<div>
    @foreach($translations as $translation)
    <a href="">traduction:{{$translation->translation}} id {{$translation->word_id}}</a>
    <br>
    @endforeach
</div>