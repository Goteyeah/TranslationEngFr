<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      @vite('resources/css/app.css')
    <title>Document</title>
  </head>
  <body>
  @component('components.exemple-t-w')
<h5>essai composant</h5>
@endcomponent
<!--component venant de exemple-t-w.blade dans ressource/ view/ components-->
  </body>
</html>