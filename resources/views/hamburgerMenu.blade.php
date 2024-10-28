<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="style.css">

    <style type="text/tailwindcss">
        @layer utilities {
        .textShadow {
            text-shadow: -3px 3px 0 red;
            font-size: 5rem;
        }
    }
</style>
</head>

<body>

    
<br>
    <x-modal-input-ga></x-modal-input-ga>
    <div> <!--hamburger ico-->
        <div class="fixed top-10 left-[100px] text-4xl cursor-pointer">
            <ion-icon name="menu" onclick="Open(this)"></ion-icon>
        </div>

        <!-- main menu -->
        <div class="fixed bg-[#002626] w-0 h-screen text-white flex justify-center items-center text-4xl tracking-[1px] overflow-hidden origin-left duration-500"
            id="Hammm">
            <ul>
                <li class="hover:textShadow duration-500 hover:translate-y-[-5px] mb-4"><a href="#" data-value="1"
                        >Ordre
                        alphabétique</a></li>
                        <li class="hover:textShadow duration-500 hover:translate-y-[-5px] mb-4"><a href="#" data-value="2"
                        >Nombre de traductions</a></li>

                <li class="hover:textShadow duration-500 hover:translate-y-[-5px] mb-4"><x-modal-input-ga>
                </x-modal-input-ga>
                <li class="hover:textShadow duration-500 hover:translate-y-[-5px] mb-4"><a href="#">service</a></li>
                <li class="hover:textShadow duration-500 hover:translate-y-[-5px] mb-4"><a href="#">about</a></li>
                <li class="hover:textShadow"><a href="#">contact</a></li>
            </ul>
            <!-- close button -->
            <div class="absolute top-[40px] right-[100px] text-[40px] cursor-pointer">
                <ion-icon name="close" onclick="Close(this)"></ion-icon>
            </div>
        </div>
        <!-- heading some text-->
        <div class="flex items-center justify-center h-screen m-auto max-w-[70ch]">
            <div>
                <h1 class="text-4xl mb-5 tracking-wide font-bold">Menu burger</h1>
                <span class="font-semibold">
                    <p class="mb-[15px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quod culpa
                        corporis
                        recusandae
                        maiores perspiciatis aperiam voluptate atque iure laboriosam facere nam, nobis aspernatur
                        eligendi
                        cum tenetur quos! Voluptas, consequuntur.</p>
                    <p class="mb-[15px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime sint vel, eaque
                        culpa tenetur,
                        magni, nostrum laborum harum iure mollitia dolorum molestias non aliquam delectus minus amet
                        adipisci quam! Voluptatibus.</p>
                    <p class="mb-[15px]"> tur adipisicing elit. Maxime sint vel, eaque culpa tenetur,
                        magni, nostrum laborum harum iure mollitia dolorum molestias non aliquam delect </p>

                </span>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script>
        let ham = document.getElementById('Hammm');
        function Open() {
            ham.classList.add('w-[50%]')
        }
        function Close() {
            ham.classList.remove('w-[50%]')
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>