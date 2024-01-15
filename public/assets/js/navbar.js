document.addEventListener('DOMContentLoaded', function () {
    var profileNavbar = document.getElementById('ProfileNavbar');
    profileNavbar.addEventListener('click', function () {
        this.classList.toggle('showText');
    });
    profileNavbar.addEventListener('click', function () {
        this.classList.toggle('logout');
    });
});