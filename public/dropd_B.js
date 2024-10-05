console.log('ordonner');

// debut du script dropdown

document.addEventListener('DOMContentLoaded', function () {
    var dropdownButton = document.getElementById('dropdownDefaultButtonD'); // vise le bouton par son id
    var dropdownMenu = document.getElementById('dropdownD'); // on vise le menu par son id
    var dropdown_option = dropdownMenu.querySelectorAll('.ordonner'); //selectionner toutes les class="" avec 'ordonner'

    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');

    });

    dropdown_option.forEach(function (option) {
        option.addEventListener('click', function (event) {
            dropdownMenu.classList.add('hidden');


            var inputA = document.getElementById('ordoAlphabetique');
            inputA.classList.add('hidden');

            var inputB = document.getElementById('ordoNbTraductions');
            inputB.classList.add('hidden');

            var inputC = document.getElementById('ordoDateCreation');
            inputC.classList.add('hidden');


            var inputHidden = document.getElementById('ordonnerR');

            var value = option.getAttribute('data-value');


            if (value == '1') {
                inputHidden.setAttribute('value', 1);
                inputA.classList.remove('hidden');
                console.log('passe par inputA');

            }
            else if (value == '2') {
                inputHidden.setAttribute('value', 2);
                inputB.classList.remove('hidden');
                console.log('passr par inputB');
            }
            else if (value == '3') {

                inputHidden.setAttribute('value', 3);
                inputC.classList.remove('hidden');
                console.log('passe par inputC');


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