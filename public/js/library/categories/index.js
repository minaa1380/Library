
$('#form_submit').click(function () {
    $('.invalid-feedback').fadeOut();
    if (validate()) {
        $(this).find('.indicator-label').fadeOut()
        $(this).find('.indicator-progress').fadeIn()
        $('#main_form').submit();
    }

});
var dialog = $('#editModal');
dialog.find('#form_submit').click(function () {
    dialog.find('.invalid-feedback').fadeOut();
    if (validate(dialog)) {
        $(this).find('.indicator-label').fadeOut()
        $(this).find('.indicator-progress').fadeIn()
        dialog.find('#main_form').submit();
    }
});
dialog.find('#form_cancell').click(function () {
    dialog.modal('hide');
});

function validate(dialog = null) {
    if (dialog != null)
        var title = dialog.find('#title');
    else
        var title = $('#title');

    if (!title.val()) {
        title.parent().find('.invalid-feedback').text(' * عنوان دسته بندی الزامیست .');
        title.parent().find('.invalid-feedback').fadeIn();
        return false;
    }

    return true;
}

$('.edit').on('click', function () {

    var modal = $('#editModal');
    modal.modal('show');

    var info = JSON.parse($(this).closest('tr').attr('data-info'));
    modal.find('#title').val(info.title);
    modal.find('#parent_id').val(info.parent_id);
    modal.find('#parent_id').trigger('change');
    modal.find('#main_form').attr('action', $(this).attr('data-link'));

});



$('.delete').on('click', function () {

    var name = $(this).attr('data-name');
    var link = $(this).attr('data-link');

    Swal.fire({
        title: "حذف دسته بندی " + name,
        text: "آیا از حذف دسته بندی " + name + "  مطمعن هستید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "بله ، حذف شود",
        cancelButtonText: "خیر"
    }).then((result) => {
        if (result.isConfirmed)
            deleteItem(link, $(this));
    });
});

function deleteItem(url, element) {
    $.ajax({
        headers: {
            'X-CSRF-Token': token
        },
        url: url,
        type: 'post',
        data: { '_method': 'DELETE' },
        success: function (data) {
            if (data.status == 200) {
                element.closest("tr").remove();
                Swal.fire({
                    text: data.message,
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "باشه",
                })
            }
        },
        error: function (t) {
            console.log(t);
        },
    });
}
