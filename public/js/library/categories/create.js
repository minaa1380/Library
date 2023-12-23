
$('#form_submit').click(function () {
    $('.invalid-feedback').fadeOut();
    if (validate()){
        $(this).find('.indicator-label').fadeOut()
        $(this).find('.indicator-progress').fadeIn()
        $('#main_form').submit();
    }

});

function validate() {
    var name = $('#name');
    var family = $('#family');
    var username = $('#username');
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

    return flag;
}