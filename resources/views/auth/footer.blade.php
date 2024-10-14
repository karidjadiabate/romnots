<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counterup/counterup.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script>
    $('#form-fgpwd').on('click', function() {
        $('#form-contain-conn').hide(1000);
        $('#form-contain-fgpwd').show(1000);
    });

    $('#return-to-conn').on('click', function() {
        $('#form-contain-conn').show(1000);
        $('#form-contain-fgpwd').hide(1000);
    });

    function togglePassword0() {
        const password = document.getElementById('password');
        const pc_eye = document.querySelector('.fa-eye0');
        const pc_far = document.querySelector('.fa-eye-slash0');
        if (password.type === 'password') {
            password.type = 'text';
            pc_eye.style.display = "block";
            pc_far.style.display = "none";
        } else {
            password.type = 'password';
            pc_eye.style.display = "none";
            pc_far.style.display = "block";
        }
    }

    function togglePassword1() {
        const password = document.getElementById('fg-password');
        const pc_eye = document.querySelector('.fa-eye1');
        const pc_far = document.querySelector('.fa-eye-slash1');
        if (password.type === 'password') {
            password.type = 'text';
            pc_eye.style.display = "block";
            pc_far.style.display = "none";
        } else {
            password.type = 'password';
            pc_eye.style.display = "none";
            pc_far.style.display = "block";
        }
    }

    function togglePassword2() {
        const password = document.getElementById('fg-confpassword');
        const pc_eye = document.querySelector('.fa-eye2');
        const pc_far = document.querySelector('.fa-eye-slash2');
        if (password.type === 'password') {
            password.type = 'text';
            pc_eye.style.display = "block";
            pc_far.style.display = "none";
        } else {
            password.type = 'password';
            pc_eye.style.display = "none";
            pc_far.style.display = "block";
        }
    }
</script>
</body>

</html>
