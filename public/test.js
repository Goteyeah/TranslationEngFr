console.log('ca fonctionne entree dasn je');

// debut du script dropdown

document.addEventListener('DOMContentLoaded', function () {
    var dropdownButton = document.getElementById('dropdownDefaultButton'); // vise le bouton par son id
    var dropdownMenu = document.getElementById('dropdown'); // on vise le menu par son id

    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden'); // on met hidden dans la class
    });

    window.addEventListener('click', function (e) { //click dans la fenêtre exterieure au bouton >> fonction anonyme
        if (!dropdownButton.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});

//Fin du script dropdown