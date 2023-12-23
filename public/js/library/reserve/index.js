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
