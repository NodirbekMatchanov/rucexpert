$(document).ready(function () {
    init();

    function init() {
        bindAction();
        // $('#phone').mask('+0000000000000');
    }

    function bindAction() {
        $(document).on('click', '#send-sms', function () {
            $.ajax({
                url: '/site/send-code?phone=' + $('#phone').val(),
            }).done(function (data) {
                if (data) {
                    alert('sms отправлено!');
                } else {
                    alert('sms не отправлено!');
                }
            }).fail(function () {
                console.log('err');
            })
        });
        $(document).on('change', '.reg_type', function () {
            let regType = $('.reg_type');
            $.each(regType, function (key, item) {
                if (item.checked) {
                    if ($(item).attr('data-type') == 'hotel') {
                        $('.hotel-inputs').removeClass('hidden');
                    } else {
                        $('.hotel-inputs').addClass('hidden');
                    }
                    $('.registration-form').removeClass('hidden');
                    return false;
                } else {
                    $('.registration-form').addClass('hidden');
                }
            });
        });
    }


    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    };

    $("#account-upload").on('change', function () {
        readURL(this);
    });

    $(".avatar-upload").on('click', function () {
    });
    //
    $(document).on('click', '.fast-sign-reg', function () {
        let email = $('input[name="email"]').val();
        let phone = $('input[name="phone"]').val();
        if (phone != '' && email != '') {
            if (ValidateEmail(email)) {

                $.ajax({
                    url: '/site/fast-signup?phone=' + $('input[name="phone"]').val() + '&email=' + $('input[name="email"]').val()
                }).done(function (data) {
                    $('.modal-body').html(data);
                    $('#openModal').trigger('click');
                }).fail(function (err) {

                })
            } else {
                alert('Значение «email» не является правильным email адресом.')
            }
        } else {
            alert('Зполняйте полей для быстрого регистрации');
        }

    });
    // быстрая регистрация
    $(document).on('click', '.signup-button', function () {
        var phone = $('input[name="FastSignupForm[phone]"]').val();
        var email = $('input[name="FastSignupForm[email]"]').val();
        var code = $('input[name="FastSignupForm[code]"]').val();
        $.ajax({
            url: '/site/fast-signup',
            method: "POST",
            data: {"FastSignupForm[code]": code, "FastSignupForm[email]": email, "FastSignupForm[phone]": phone}
        }).done(function (data) {
            if (!data) {
                $('.field-fastsignupform-code').addClass('has-error');
                $('.field-fastsignupform-code').find('.help-block.help-block-error').html('Некорректный код');
            }
        }).fail(function (err) {

        })
    });

    function ValidateEmail(mail) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
            return (true)
        }
        return (false)
    }

    // кликаем на кнопку вход чтобы открывался модалка для входа
    $(document).on('click','.authorization',function () {
        $('#headerAccount .login').trigger('click');
    });

    $(document).on('click','#specialButton',function () {
        $('.header.header-nav-menu').css("margin-top","50px")
    });
    setTimeout(function () {
        if($('.special-quit button').length){
            $('.header.header-nav-menu').css("margin-top","50px")
        }
    },2000);
    $(document).on('click','.special-quit button',function () {
        $('.header.header-nav-menu').css("margin-top","0px")
    });

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
    });

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
    });


});