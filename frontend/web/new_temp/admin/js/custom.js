$(document).ready(function () {
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
    $('.profile-image-button').click(function () {
        $('#account-upload').trigger('click');
    })
});