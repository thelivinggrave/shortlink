document.addEventListener("DOMContentLoaded", function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $("#submit-button").on("click", function (e) {
        let url = $("#link-url").val();

        if (!isURL(url))
            return alert("Неверный URL-адрес!");

        $.ajax({
            url: window.location.href + "ajax",
            method: "POST",
            dataType: "json",
            data: {
                "url": url,
            },
            statusCode: {
                500: () =>
                {
                    $(".messages")[0].innerHTML = "<div class='alert alert-danger'>Внутренняя ошибка сервера!</div>";
                }
            },
            beforeSend: () => {
                $("#short-url").val("Создаем короткую ссылку...");
            },
            complete: (data, status) =>
            {
                let shortUrl = window.location.href + data.responseJSON.code;
                console.log(data.responseJSON.code);
                $("#short-url").val(shortUrl);
            }
        });
    });

});

function isURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)'+
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+
        '((\\d{1,3}\\.){3}\\d{1,3}))'+
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+
        '(\\?[;&a-z\\d%_.~+=-]*)?'+
        '(\\#[-a-z\\d_]*)?$','i');
    return pattern.test(str);
}
