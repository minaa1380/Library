$(document).ready(function () {

    $(document).on('click', '.pagination a', function (event) {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];

        $("#table").empty().html(`
        <div class="row container">
            <div class="text-center" style="margin: 1rem 0.5rem;font-size: 1.5rem;">
                <span class="text">درحال دریافت  اطلاعات ، لطفا شکیبا باشید .... </span>
                <span class="spinner spinner-border spinner-border-sm align-middle ms-2" style="display:inline-block"></span>
            </div>
        </div>
        `);

        search(page);
    });

    $(document).on('click', '#btn-search', function (event) {
        $('#list').fadeIn(500);
        $("#table").empty().html(`
                <div class="row container">
                    <div class="text-center" style="margin: 1rem 0.5rem;font-size: 1.5rem;">
                        <span class="text">درحال دریافت  اطلاعات ، لطفا شکیبا باشید .... </span>
                        <span class="spinner spinner-border spinner-border-sm align-middle ms-2" style="display:inline-block"></span>
                    </div>
                </div>
            `);
        search(1);
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
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    $(document).on('click', '.submit-reserve', function (event) {

        var btn = $(this);
        btn.find('.indicator-label').hide();
        btn.find('.indicator-progress').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': token
            },
            type: 'get',
            url: $(this).attr('data-link'),
            success: function (data) {
                btn.find('.indicator-label').show();
                btn.find('.indicator-progress').hide();
                if (data.status == 200) {
                    toastr.success(data.message);
                    btn.parent().html(`
                        <div class="badge badge-danger">
                            <span>در دست امانت </span>
                        </div>
                    `);
                }
                else
                    toastr.error(data.message);
            },
            error: function (e) {
                console.log(e);
                btn.find('.indicator-label').show();
                btn.find('.indicator-progress').hide();

            }
        });

    });

});