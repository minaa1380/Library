$(document).ready(function(){
    $('#exit').click(function(){
        Swal.fire({
            html: `<p class="fs-3">آیا میخواهید از حساب خود خارج شوید ؟</p>`
            , icon: "question"
            , buttonsStyling: false
            , showCancelButton: true
            , confirmButtonText: "خروج"
            , cancelButtonText: 'انصراف'
            , customClass: {
                confirmButton: "btn btn-danger"
                , cancelButton: 'btn btn-primary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#exitForm').submit();
            }
        });
    });
});