$(document).ready(function () {
    $('.delete').on('click', function () {
        var name = $(this).attr('data-name');
        var link = $(this).attr('data-link');

        Swal.fire({
            title: "حذف کتاب " + name,
            text: "آیا از حذف کتاب " + name + "  مطمعن هستید؟",
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

        $("#mainTable").empty().html(`
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
        $("#mainTable").empty().html(`
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
            data: { 'word': word, 'isBookPage': true },
            success: function (data) {
                $('#mainTable').html(data);
                KTMenu.createInstances();
            },
            error: function (e) {
                console.log(e);
            }
        });

    }

    var book_id = 0;
    var reserve_dialog = $('#reserveModal');
    $('.reserve').on('click', function () {
        reserve_dialog.modal('show');
        reserve_dialog.find('#search_input_modal').val('');
        reserve_dialog.find('#table').empty();
        reserve_dialog.find('#book').text($(this).attr('data-title'));
        book_id = $(this).attr('data-book-id');

    });


    reserve_dialog.find('.modal-footer').find('button').click(function () {
        reserve_dialog.modal('hide');
    });

    reserve_dialog.find('.pagination a').on('click', function (event) {
        reserve_dialog.find('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];

        reserve_dialog.find("#table").empty().html(`
        <div class="row container">
            <div class="text-center" style="margin: 1rem 0.5rem;font-size: 1.5rem;">
                <span class="text">درحال دریافت  اطلاعات ، لطفا شکیبا باشید .... </span>
                <span class="spinner spinner-border spinner-border-sm align-middle ms-2" style="display:inline-block"></span>
            </div>
        </div>`
        );

        usersSearch(page);
    });

    $(document).on('keyup', reserve_dialog.find('#search_input_modal'), function (event) {
        reserve_dialog.find("#table").empty().html(`
            <div class="row container">
                <div class="text-center" style="margin: 1rem 0.5rem;font-size: 1.5rem;">
                    <span class="text">درحال دریافت  اطلاعات ، لطفا شکیبا باشید .... </span>
                    <span class="spinner spinner-border spinner-border-sm align-middle ms-2" style="display:inline-block"></span>
                </div>
            </div>`
        );
        usersSearch(1);
        // }
    });


    function usersSearch(page) {
        var word = reserve_dialog.find('#search_input_modal').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': token
            },
            type: 'post',
            url: users_search_url + '?page=' + page,
            data: { 'word': word, 'isBookPage': true },
            success: function (data) {
                reserve_dialog.find('#table').html(data);
                KTMenu.createInstances();
            },
            error: function (e) {
                console.log(e);
            }
        });
    }


    $(document).on('click', '.user_submit_reserve', function (event) {

        var btn = $(this);
        btn.find('.indicator-label').fadeOut();
        btn.find('.indicator-progress').fadeIn();
        var user_id = $(this).attr('data-user-id');
        if (book_id > 0) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                type: 'post',
                url: $(this).attr('data-link'),
                data: { 'user_id': user_id, 'book_id': book_id },
                success: function (data) {
                    btn.find('.indicator-label').fadeIn();
                    btn.find('.indicator-progress').fadeOut();
                    if (data.status == 200)
                        toastr.success(data.message);
                    else
                        toastr.error(data.message);
                    reserve_dialog.modal('hide');
                },
                error: function (e) {
                    console.log(e);
                    btn.find('.indicator-label').fadeIn();
                    btn.find('.indicator-progress').fadeOut();

                }
            });
        }
        else {
            alert('book_id not Valid');
        }

    });
});