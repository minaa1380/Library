
$(document).on('click', '.delivery', function () {

    var name = $(this).attr('data-name');
    var link = $(this).attr('data-link');

    Swal.fire({
        title: "تحویل کتاب " + name,
        text: "آیا از تحویل کتاب " + name + "  مطمعن هستید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "بله ، تحویل شود",
        cancelButtonText: "خیر"
    }).then((result) => {
        if (result.isConfirmed)
            delivery(link, $(this));
    });
});

function delivery(url, element) {
    $.ajax({
        headers: {
            'X-CSRF-Token': token
        },
        url: url,
        type: 'get',
        success: function (data) {
            console.log(data);
            if (data.status == 200) {
                // element.closest("tr").remove();
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
    </div>`
    );

    search(page);
});

$(document).on('keyup', '#search_input', function (event) {
    if ($(this).val().length >= 3) {
        $("#table").empty().html(`
        <div class="row container">
            <div class="text-center" style="margin: 1rem 0.5rem;font-size: 1.5rem;">
                <span class="text">درحال دریافت  اطلاعات ، لطفا شکیبا باشید .... </span>
                <span class="spinner spinner-border spinner-border-sm align-middle ms-2" style="display:inline-block"></span>
            </div>
        </div>`
        );
        search(1);
    }
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
            // console.log(data)
            $('#table').html(data);
            KTMenu.createInstances();
        },
        error: function (e) {
            console.log(e);
        }
    });
}