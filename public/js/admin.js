function approve(id, btn) {
    json('/admin/approve/' + id, function (response) {
        console.log(response);
        if (response.success) {
            btn.parentNode
                .querySelectorAll('.btn-action')
                .forEach(function (btn) {
                    btn.remove();
                });
            document.getElementById('status' + id).innerHTML = '<div class="text-success">принят</div>';
        }
    });
}

function decline(id, btn) {
    json('/admin/decline/' + id, function (response) {
        console.log(response);
        if (response.success) {
            btn.parentNode
                .querySelectorAll('.btn-action')
                .forEach(function (btn) {
                    btn.remove();
                });
            document.getElementById('status' + id).innerHTML = '<div class="text-danger">отклонен</div>';
        }
    });
}

function json(uri, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', uri, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState != 4) return;

        if (xhr.status !== 200) {
            alert(xhr.statusText);
        }

        callback(JSON.parse(xhr.responseText));
    };

    xhr.send();
}