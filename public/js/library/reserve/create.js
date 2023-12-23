
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
    var name = $('#name');
    var author = $('#author');
    var publisher = $('#publisher');
    var category_id = $('#category_id');
    var inventory = $('#inventory');

    var flag = true;

    if (!name.val()) {
        name.parent().find('.invalid-feedback').text(' * نام کتاب الزامیست .');
        name.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    if (!author.val()) {
        author.parent().find('.invalid-feedback').text(' * نام نویسنده الزامیست.');
        author.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }

    if (!publisher.val()) {
        publisher.parent().find('.invalid-feedback').text(' * انتشارات الزامیست .');
        publisher.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }
    // if (!category_id.val()) {
    //     category_id.parent().find('.invalid-feedback').text(' * دسته بندی کتاب الزامیست .');
    //     category_id.parent().find('.invalid-feedback').fadeIn();
    //     flag = false;
    // }

    if (!inventory.val()) {
        inventory.parent().find('.invalid-feedback').text(' * تعداد کل الزامیست .');
        inventory.parent().find('.invalid-feedback').fadeIn();
        flag = false;
    }

    return flag;
}