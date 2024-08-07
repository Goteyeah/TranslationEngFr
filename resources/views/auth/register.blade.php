
<x-guest-layout>
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname JE SUIS DANS LE LAYOUT auth.registrer.blade et les x-quelquechose sont des components-->
         <div class="mt-4">
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autocomplete="surname"/>
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
         </div>
        <!-- Surname JE SUIS DANS LE LAYOUT auth.registrer.blade et les x-quelquechose sont des components -->

       
         <!-- boutton radio pour genre avec un flex item center avec le même name="genre"-->
<div class="flex items-center space-x-4 ">
         <div class="mt-4">
            <x-input-label for="genre" :value="__('Homme')" />
            <x-text-input id="genre" class="block mt-1 w-full" type="radio" name="genre" :value="0" required autocomplete="genre"/>
            <x-input-error :messages="$errors->get('genre')" class="mt-2" />
         </div>

         <div class="mt-4">
            <x-input-label for="genre" :value="__('Femme')" />
            <x-text-input id="genre" class="block mt-1 w-full" type="radio" name="genre" :value="1" required autocomplete="genre"/>
            <x-input-error :messages="$errors->get('genre')" class="mt-2" />
         </div>
    </div><br>
    <div class="flex items-center space-x-4 ">
        <div class="mt-4"></div>
        <x-input-label for="genre" :value="__('Section')" />
          
    </div>
 
            
             

 <!-- menu deroulant rempli du tableau de section qui vient de nbsection-->
              <div class="mt-4">

<select name="sections">
@foreach($tabSection as $section)
   <option value="{{$section->id}}">{{$section->name}}</a></option>
@endforeach
    </select>

</div>
<!-- menu deroulant rempli du tableau de section qui vient de nbsection--->



              



        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
