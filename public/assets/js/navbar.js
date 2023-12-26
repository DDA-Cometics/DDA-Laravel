document.addEventListener('DOMContentLoaded', function () {
    var profileNavbar = document.getElementById('ProfileNavbar');

    profileNavbar.addEventListener('click', function () {
        // Chuyển đổi lớp 'showText' khi click vào icon
        this.classList.toggle('showText');
    });
    profileNavbar.addEventListener('click', function () {
        // Chuyển đổi lớp 'logout' khi click vào icon
        this.classList.toggle('logout');
    });
});