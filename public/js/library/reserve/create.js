
$("#kt-user").select2({
    data: selectedManager,
    ajax: {
        url: userSearchUrl,
        dataType: "json",
        type: "POST",
        delay: 250,
        data: function (params) {
            return {
                word: params.term, // search term
                _token: token,
            };
        },
        processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used

            return {
                results: data,
            };
        },
        cache: true,
    },
    placeholder: "درحال جستجو ...",
    minimumInputLength: 2,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection,
});

// $('#kt-manager').on("load", function() {
//     $('#kt-manager').val('1').trigger('change');
// });

function formatRepo(repo) {
    if (repo.loading) {
        return "درحال جستجو ...";
    }
    var $container = $(
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__avatar' style='width:fit-content;display:inline-block;'><img src='" +
        userPicPath +
        repo.pic +
        "' style='width:70px;'/></div>" +
        "<div class='select2-result-repository__meta' style='width: fit-content;display: inline-block;vertical-align: middle;margin-right: 12px;'>" +
        "<div class='select2-result-repository__title' style='margin-bottom:8px;'></div>" +
        "<div class='select2-result-repository__description'></div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.name+' '+repo.family);
    $container
        .find(".select2-result-repository__description")
        .text(repo.username);
    $("#user_id").val(repo.id);

    return $container;
}

function formatRepoSelection(repo) {
    return repo.name || repo.family;
}
 // book
 $("#kt-book").select2({
    data: selectedManager,
    ajax: {
        url: bookSearchUrl,
        dataType: "json",
        type: "POST",
        delay: 250,
        data: function (params) {
            return {
                word: params.term, // search term
                _token: token,
            };
        },
        processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used

            return {
                results: data,
            };
        },
        cache: true,
    },
    placeholder: "درحال جستجو ...",
    minimumInputLength: 2,
    templateResult: formatRepoBook,
    templateSelection: formatRepoSelectionBook,
});

// $('#kt-manager').on("load", function() {
//     $('#kt-manager').val('1').trigger('change');
// });

function formatRepoBook(repo) {
    if (repo.loading) {
        return "درحال جستجو ...";
    }
    var $container = $(
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__avatar' style='width:fit-content;display:inline-block;'><img src='" +
        bookPicPath +
        repo.pic +
        "' style='width:70px;'/></div>" +
        "<div class='select2-result-repository__meta' style='width: fit-content;display: inline-block;vertical-align: middle;margin-right: 12px;'>" +
        "<div class='select2-result-repository__title' style='margin-bottom:8px;'></div>" +
        "<div class='select2-result-repository__description'></div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.title+' - '+repo.author);
    $container
        .find(".select2-result-repository__description")
        .text(repo.barcode);
    $("#book_id").val(repo.id);

    return $container;
}

function formatRepoSelectionBook(repo) {
    return repo.title || repo.author;
}



$('#form_submit').click(function () {
    $('.invalid-feedback').fadeOut();
    if (validate()) {
        $(this).find('.indicator-label').fadeOut()
        $(this).find('.indicator-progress').fadeIn()
        $('#main_form').submit();
    }
});

function validate() {
    var book = $('#book_id');
    var user = $('#user_id');
    var period = $('#period');
    var flag = true;

    if (!book.val()) {
        book.parent().find('.invalid-feedback').text(' * کتاب موردنظر الزامیست .');
        book.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    if (!user.val()) {
        user.parent().find('.invalid-feedback').text(' * کاربر رزرو کننده الزامیست.');
        user.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }

    if (!period.val()) {
        period.parent().find('.invalid-feedback').text(' * مدت امانت الزامیست .');
        period.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }

    return flag;
}