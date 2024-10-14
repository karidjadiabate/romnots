document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('registrationForm').addEventListener('submit', function (event) {
        // Réinitialiser les erreurs précédentes
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        let isValid = true;

        // Liste des ID de champs à vérifier
        const fieldIds = ['firstName', 'lastName', 'contact', 'email', 'schoolName', 'schoolAddress', 'password', 'confirmPassword', 'rememberMe'];

        fieldIds.forEach(id => {
            const field = document.getElementById(id);
            if (field) {
                const value = field.value.trim();
                // Vérifier si le champ est vide
                if (value === '' && id !== 'rememberMe') {
                    isValid = setInvalid(field);
                }
                // Vérification spécifique pour contact
                else if (id === 'contact' && !/^\d+$/.test(value)) {
                    isValid = setInvalid(field);
                }
                // Vérification spécifique pour email
                else if (id === 'email' && !validateEmail(value)) {
                    isValid = setInvalid(field);
                }
                // Vérification spécifique pour rememberMe
                else if (id === 'rememberMe' && !field.checked) {
                    isValid = setInvalid(field);
                }
            }
        });

        // Vérification des mots de passe
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('confirmPassword').value.trim();

        if (password === '') {
            isValid = setInvalid(document.getElementById('password'));
        }
        if (confirmPassword === '' || password !== confirmPassword) {
            isValid = setInvalid(document.getElementById('confirmPassword'));
        }

        if (!isValid) {
            event.preventDefault(); // Empêche la soumission du formulaire si des champs sont invalides
        }
    });

    function setInvalid(field) {
        field.classList.add('is-invalid');
        return false;
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    document.querySelectorAll('.toggle-password').forEach(item => {
        item.addEventListener('click', function () {
            const input = document.getElementById(this.getAttribute('data-toggle'));
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
});
