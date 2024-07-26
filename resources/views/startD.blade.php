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

  <x-testCompo title='lidjhsfijqhsfkjhdsilfhs'>
    <p>je rempli le slot</p>
    <p $slotB=dhhd></p>
        <x-slot name='slotB'>
          <a href="m">je rempli encore le modal avec slot</a>
        </x-slot>
</x-testCompo>
<!--component venant de exemple-t-w.blade dans ressource/ view/ components-->

<x-component_telecharge >
  <p>pezmize slot</p>
  <x-slot name=slotB> menu champagne </x-slot>
</x-component_telecharge>

