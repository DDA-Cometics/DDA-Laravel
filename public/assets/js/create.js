document.getElementById('showForm').addEventListener('click', function () {
    var form = document.querySelector('#Cform form'); // Chọn phần tử form bên trong #Cform
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
});
