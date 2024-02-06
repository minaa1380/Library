$(document).ready(function () {

    $(document).on('click', '#form_submit', function () {
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

    $(document).on('click', '.edit', function () {

        var modal = $('#editModal');
        modal.modal('show');

        var info = JSON.parse($(this).closest('tr').attr('data-info'));
        modal.find('#title').val(info.title);
        modal.find('#parent_id').val(info.parent_id);
        modal.find('#parent_id').trigger('change');
        modal.find('#main_form').attr('action', $(this).attr('data-link'));

    });



    $(document).on('click', '.delete', function () {

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

    $(document).on('click', '.pagination a', function (event) {
        $(this).find('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];

        $("#table").empty().html(`
        <div class="row container">
            <div class="text-center" style="margin: 1rem 0.5rem;font-size: 1.5rem;">
                <span class="text">درحال دریافت  اطلاعات ، لطفا شکیبا باشید .... </span>
                <span class="spinner spinner-border spinner-border-sm align-middle ms-2" style="display:inline-block"></span>
            </div>
        </div>`
        );

        search(page);
    });

    $(document).on('keyup', '#search_input', function (event) {
        $("#table").empty().html(`
            <div class="row container">
                <div class="text-center" style="margin: 1rem 0.5rem;font-size: 1.5rem;">
                    <span class="text">درحال دریافت  اطلاعات ، لطفا شکیبا باشید .... </span>
                    <span class="spinner spinner-border spinner-border-sm align-middle ms-2" style="display:inline-block"></span>
                </div>
            </div>`
        );
        search(1);
        // }
    });

    function search(page) {
        var word = $('#search_input').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': token
            },
            type: 'post',
            url: search_url + '?page=' + page,
            data: { 'word': word },
            success: function (data) {
                $('#table').html(data);
                KTMenu.createInstances();
            },
            error: function (e) {
                console.log(e);
            }
        });

    }

});
