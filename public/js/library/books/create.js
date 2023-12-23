
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
    var author = $('#author');
    var publisher = $('#publisher');
    var category_id = $('#category_id');
    var inventory = $('#inventory');
    
    var flag = true;
    
    if (!name.val()) {
        name.parent().find('.invalid-feedback').text(' * نام کتاب الزامیست .');
        name.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    if (!author.val()) {
        author.parent().find('.invalid-feedback').text(' * نام نویسنده الزامیست.');
        author.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }

    if (!publisher.val()) {
        publisher.parent().find('.invalid-feedback').text(' * انتشارات الزامیست .');
        publisher.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    // if (!category_id.val()) {
    //     category_id.parent().find('.invalid-feedback').text(' * دسته بندی کتاب الزامیست .');
    //     category_id.parent().find('.invalid-feedback').fadeIn();
    //     flag = false;
    // }

    if (!inventory.val()) {
        inventory.parent().find('.invalid-feedback').text(' * تعداد کل الزامیست .');
        inventory.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }

    return flag;
}