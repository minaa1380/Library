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
        var reserved = $('#reserved').is(':checked');
        var free = $('#free').is(':checked');
        var status = 2;
        if (reserved && free) {
            status = 2;
        } else if (reserved) {
            status = 1;
        } else if (free) {
            status = 0;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': token
            },
            type: 'post',
            url: search_url + '?page=' + page,
            data: { 'word': word, 'status': status },
            success: function (data) {
                $('#table').html(data);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

});