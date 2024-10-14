document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const lockIcon = document.getElementById('lockIcon');
    const emailField = document.getElementById('username');
    const emailIcon = document.getElementById('emailIcon');
    const rememberMeCheckbox = document.getElementById('rememberMe');

    togglePassword.addEventListener('click', togglePasswordFieldVisibility);
    passwordField.addEventListener('focus', hideLockIcon);
    passwordField.addEventListener('blur', showLockIcon);
    emailField.addEventListener('focus', hideEmailIcon);
    emailField.addEventListener('blur', showEmailIcon);
    rememberMeCheckbox.addEventListener('change', toggleRememberMe);

    function togglePasswordFieldVisibility() {
        const isPassword = passwordField.type === 'password';
        passwordField.type = isPassword ? 'text' : 'password';
        togglePassword.classList.toggle('fa-eye-slash', !isPassword);
        togglePassword.classList.toggle('fa-eye', isPassword);
    }

    function hideLockIcon() {
        lockIcon.style.display = 'none';
    }

    function showLockIcon() {
        if (passwordField.value.length === 0) lockIcon.style.display = 'block';
    }

    function hideEmailIcon() {
        emailIcon.style.display = 'none';
    }

    function showEmailIcon() {
        if (emailField.value.length === 0) emailIcon.style.display = 'block';
    }

    function toggleRememberMe() {
        if (rememberMeCheckbox.checked) {
            localStorage.setItem('rememberMe', 'true');
        } else {
            localStorage.removeItem('rememberMe');
        }
    }

    // Initialisation de "Se souvenir de moi" à partir de localStorage
    const rememberMeChecked = localStorage.getItem('rememberMe') === 'true';
    rememberMeCheckbox.checked = rememberMeChecked;
});
