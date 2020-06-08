$(document).ready(function () {


    $(document).on('click', '.admin-success', function () {
        $.ajax({
            url: 'admin-success?id=' + $(this).attr('data-id')
        }).done(function (data) {
            if(data){
                toastr.success('Опубликовано');
                window.location.reload();
            } else {
                toastr.warning('Что то пошло не так')
            }
        }).fail(function (err) {
            toastr.warning('Что то пошло не так')
        })
    });

    $(document).on('click', '.admin-cancel', function () {
        $.ajax({
            url: 'admin-cancel?id=' + $(this).attr('data-id')
        }).done(function (data) {
            if(data){
                toastr.success('Отменено');
                window.location.reload();
            } else {
                toastr.warning('Что то пошло не так')
            }
        }).fail(function (err) {
            toastr.warning('Что то пошло не так')
        })
    })

    $(document).on('click', '.news-success', function () {
        $.ajax({
            url: 'news-success?id=' + $(this).attr('data-id')
        }).done(function (data) {
            if(data){
                toastr.success('Опубликовано');
                window.location.reload();
            } else {
                toastr.warning('Что то пошло не так')
            }
        }).fail(function (err) {
            toastr.warning('Что то пошло не так')
        })
    })

    $(document).on('click', '.news-cancel', function () {
        $.ajax({
            url: 'news-cancel?id=' + $(this).attr('data-id')
        }).done(function (data) {
            if(data){
                toastr.success('Отменено');
                window.location.reload();
            } else {
                toastr.warning('Что то пошло не так')
            }
        }).fail(function (err) {
            toastr.warning('Что то пошло не так')
        })
    })
});