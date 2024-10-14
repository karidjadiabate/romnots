/* <script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuIcon = document.getElementById('menuIcon');
        var offcanvasElement = document.getElementById('offcanvasScrolling');
        var offcanvas = new bootstrap.Offcanvas(offcanvasElement);

        // Basculer l'affichage du menu offcanvas lorsque le menuIcon est cliqué
        menuIcon.addEventListener('click', function(event) {
            if (offcanvasElement.classList.contains('show')) {
                offcanvas.hide();
            } else {
                offcanvas.show();
            }
        });

        // Empêcher l'affichage du menu offcanvas lors du clic sur d'autres parties du bouton
        document.getElementById('toggleButton').addEventListener('click', function(event) {
            if (event.target !== menuIcon && !menuIcon.contains(event.target)) {
                event.stopPropagation();
            }
        }); */
// }

// Écoute l'événement de soumission du formulaire de recherche
//     document.getElementById('sea').addEventListener('submit', function(event) {
//         event.preventDefault();
//         let searchTerm = document.getElementById('sea').querySelector('input[type="search"]').value
//             .trim();
//         if (!searchTerm) {
//             alert('Veuillez saisir un terme de recherche.');
//             return;
//         }

//         alert('Vous avez recherché : ' + searchTerm);
//         fetch('/votre-endpoint-de-recherche?query=' + encodeURIComponent(searchTerm))
//             .then(response => response.json())
//             .then(data => {
//                 console.log('Résultats de la recherche :', data);
//             })
//             .catch(error => {
//                 console.error('Erreur lors de la recherche :', error);
//             });
//     });
// });



/* function setActive(event, id) {
    event.preventDefault();
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    // Ajouter la classe
//     } */
// </script>
