
$('#form_submit').click(function () {
    $('.invalid-feedback').fadeOut();
    if (validate()) {
        $(this).find('.indicator-label').fadeOut()
        $(this).find('.indicator-progress').fadeIn()
        $('#main_form').submit();
    }

});

function validate(dialog = null) {
    var app_name = $('#name');
    var penalty_for_day = $('#penalty_for_day');
    var register_cost = $('#register_cost');
    var update_cost = $('#update_cost');
    var max_user_reserve = $('#max_user_reserve');

    if (!app_name.val()) {
        app_name.parent().find('.invalid-feedback').text(' * این فیلد الزامیست .');
        app_name.parent().find('.invalid-feedback').fadeIn();
        return false;
    }
    if (!penalty_for_day.val()) {
        penalty_for_day.parent().find('.invalid-feedback').text(' * این فیلد الزامیست .');
        penalty_for_day.parent().find('.invalid-feedback').fadeIn();
        return false;
    }
    if (!register_cost.val()) {
        register_cost.parent().find('.invalid-feedback').text(' * این فیلد الزامیست .');
        register_cost.parent().find('.invalid-feedback').fadeIn();
        return false;
    }
    if (!update_cost.val()) {
        update_cost.parent().find('.invalid-feedback').text(' * این فیلد الزامیست .');
        update_cost.parent().find('.invalid-feedback').fadeIn();
        return false;
    }
    if (!max_user_reserve.val()) {
        max_user_reserve.parent().find('.invalid-feedback').text(' * این فیلد الزامیست .');
        max_user_reserve.parent().find('.invalid-feedback').fadeIn();
        return false;
    }

    return true;
}
$(document).ready(function () {
    $('input#register_cost').val(numbering($('input#register_cost')));
    $('input#update_cost').val(numbering($('input#update_cost')));
    $('input#penalty_for_day').val(numbering($('input#penalty_for_day')));
});

$('input#register_cost').add('input#update_cost').add('input#penalty_for_day').keypress(function (e) {
    if (validateNumber(e)) {
        $(this).keyup(function () {
            $(this).val(numbering($(this)))
        });
    }
});

function validateNumber(e) {
    let charCode = (e.which) ? e.which : e.keyCode
    if (String.fromCharCode(charCode).match(/[^0-9]/g))
        return false;
    return true;

}

function numbering(element) {
    let price = element.val().replace(/,/g, "");
    if (price.length > 3)
        return Number(price).toLocaleString();
    else
        return price;
}
