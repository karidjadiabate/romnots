document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editEtablissementForm{{$etablissement->id}}');

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    }, false);
});