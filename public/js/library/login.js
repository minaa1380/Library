
$('#kt_sign_in_submit').click(function () {
    $('.invalid-feedback').fadeOut();
    if (validate()){
        $(this).find('.indicator-label').fadeOut()
        $(this).find('.indicator-progress').fadeIn()
        $('#kt_sign_in_form').submit();
    }

});

function validate() {
    var username = $('#username');
    var password = $('#password');
    var flag = true;
    if (!username.val()) {
        username.parent().find('.invalid-feedback').text(' * نام کاربری الزامیست .');
        username.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    if (!password.val()) {
        password.parent().find('.invalid-feedback').text(' * رمزعبور الزامیست .');
        password.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }

    return flag;
}