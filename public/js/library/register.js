$('#form_submit').click(function () {
    $('.invalid-feedback').fadeOut();
    if (validate()) {
        $(this).find('.indicator-label').fadeOut()
        $(this).find('.indicator-progress').fadeIn()
        $('#main_form').submit();
    }

});

function validate() {
    var username = $('#username');
    var password = $('#password');
    var password_confirmation = $('#confirmPassword');
    var name = $('#name');
    var family = $('#family');
    var flag = true;

    if (!name.val()) {
        name.parent().find('.invalid-feedback').text(' * نام الزامیست .');
        name.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    if (!family.val()) {
        family.parent().find('.invalid-feedback').text(' * نام خانوادگی الزامیست .');
        family.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    if (!username.val()) {
        username.parent().find('.invalid-feedback').text(' * نام کاربری الزامیست .');
        username.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    if (!password.val()) {
        password.parent().find('.invalid-feedback').text(' * رمزعبور الزامیست .');
        password.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    } else if (password.val().length < 6) {
        password.parent().find('.invalid-feedback').text(' * رمزعبور حداقل باید 6 کاراکتر باشد .');
        password.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    if (password.val() != password_confirmation.val()) {
        password_confirmation.parent().find('.invalid-feedback').text(' * تکرار رمزعبور اشتباه است .');
        password_confirmation.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }

    return flag;
}