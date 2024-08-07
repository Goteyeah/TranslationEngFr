console.log('ca fonctionne entree dasn je');

// debut du script dropdown

document.addEventListener('DOMContentLoaded', function () {
    var dropdownButton = document.getElementById('dropdownDefaultButton'); // vise le bouton par son id
    var dropdownMenu = document.getElementById('dropdown'); // on vise le menu par son id
    var dropdown_option = dropdownMenu.querySelectorAll('.chercher');
    var inputSearch = document.getElementById('inputSearch');

    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
       
    });

    dropdown_option.forEach(function(option){
        option.addEventListener('click',function(event) {
            dropdownMenu.classList.add('hidden');
           

            var inputA = document.getElementById('inputA');
            var inputB = document.getElementById('inputB');
            var value = option.getAttribute('data-value');
            inputA.classList.add('hidden');
            inputB.classList.add('hidden');

          if (value == '1')
            {
            inputA.classList.remove('hidden');  
            
            }
            else if (value == '2')
            {
                // inputB.classList.remove('hidden');
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