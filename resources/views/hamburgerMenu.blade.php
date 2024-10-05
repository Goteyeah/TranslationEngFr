<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')

   <style type="text/tailwindcss">
    @layer utilities {
        .textShadow {
            text-shadow: -3px 3px 0 red;
        }
    }
</style>
</head>

<body>
    <div> <!--hamburger ico-->
        <div class="fixed top-10 right-[100px] text-4xl cursor-pointer">
            <ion-icon name="menu"></ion-icon>
        </div>

        <!-- main menu -->
        <div class="fixed bg-[#002626]/90 w-full h-screen text-white flex justify-center items-center text-4xl tracking-[1px]" >
            <ul>
                <li class="textShadow"><a href="#">Home</a></li>
                <li class="hover:textShadow mb-4"><a href="#">Port folio</a></li>
                <li class="hover:textShadow mb-4"><a href="#">service</a></li>
                <li class="hover:textShadow mb-4"><a href="#">about</a></li>
                <li class="hover:textShadow"><a href="#">contact</a></li>
            </ul>
        </div>
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

</body>

</html>