function preview() {
    var form = document.getElementById('new-review');
    var media = document.getElementById('preview');

    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var text = document.getElementById('text').value;
    var fileInput = document.getElementById('image');

    if (!name || !email || !text) {
        alert('Не все поля заполены');
        return false;
    }

    var emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (emailRegex.test(email)) {
        alert('Неверный email');
    }

    media.querySelector('.media-heading').innerText = name + ' | ' + email;
    media.querySelector('.text').innerText = text;

    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader;
        fileReader.onload = function (e) {
            media.getElementsByTagName('img')[0].src = e.target.result;
        };

        fileReader.readAsDataURL(fileInput.files[0]);
    }

    media.classList.remove('hidden');
    form.classList.add('hidden');
}

function closePreview() {
    document.getElementById('preview').classList.add('hidden');
    document.getElementById('new-review').classList.remove('hidden');
}