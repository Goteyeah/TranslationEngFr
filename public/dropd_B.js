console.log('ordonner');

// debut du script dropdown

document.addEventListener('DOMContentLoaded', function () {
    var dropdownButton = document.getElementById('dropdownDefaultButton_B'); // vise le bouton par son id
    var dropdownMenu = document.getElementById('dropdown_B'); // on vise le menu par son id
    var dropdown_option = dropdownMenu.querySelectorAll('.ordonner'); //selectionner toutes les class="" avec 'ordonner'

    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');

    });

    dropdown_option.forEach(function (option) {
        option.addEventListener('click', function (event) {
            dropdownMenu.classList.add('hidden');


            var inputA = document.getElementById('ordoA');
            var inputB = document.getElementById('ordoB');
            var inputC = document.getElementById('ordoC');

            var value = option.getAttribute('data-value');
            inputA.classList.add('hidden');
            inputB.classList.add('hidden');
            inputC.classList.add('hidden');

            if (value == '1') {
                inputA.classList.remove('hidden');
                console.log("inputA");
            }
            else if (value == '2') {
                inputB.classList.remove('hidden');
                console.log('inputB');
            }
            else if (value == '3') {
                inputC.classList.remove('hidden');
                console.log('inputC');
            }



            //
        });
    });

    window.addEventListener('click', function (e) { //click dans la fenêtre exterieure au bouton >> fonction anonyme
        if (!dropdownButton.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});

//Fin du script dropdown