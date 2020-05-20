$(document).ready(function () {
    init();

    function init() {
        bindAction();
        $('#phone').mask('+0000000000000');
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
           $.each(regType,function (key,item) {
              if(item.checked){
                  if($(item).attr('data-type') == 'hotel'){
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
});