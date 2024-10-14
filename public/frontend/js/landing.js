document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll('.foreground-image');
    const buttons = document.querySelectorAll('.btn-small');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.getAttribute('data-index');

            images.forEach((img, i) => {
                img.classList.remove('active');
                if (i == index) {
                    img.classList.add('active');
                }
            });

            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });
});

// alerte
document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(function () {
            alert.classList.add('fade-out');
        }, 2000); //
    }
});
