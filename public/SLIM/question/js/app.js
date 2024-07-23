
$(document).ready(function () {

    $("#createForm").submit(function (m) {
        $.ajax({
            type: "POST",
            url: "/question",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#btnSubmit').addClass('kt-spinner');
                $('#btnSubmit').attr('disabled', 'true');
            },
            complete: function () {
                $('#btnSubmit').removeClass('kt-spinner');
                $('#btnSubmit').removeAttr('disabled');

            },
            success: function (response) {
                console.log('succ');
                if (response.errors) {
                    jQuery.each(response.errors, function (key, value) {
                        //toastr.error(value);
                        console.log(value);
                    });
                } else {
                    toastr.success('Saved.');
                    $('#createForm').trigger("reset");
                    $('#modal-add-category').modal("hide");
                    $('.table-responsive').html(response);

                }
                window.location.href = "/question"

            },
            error: function (reject) {

                if (reject.status === 422) {
                    var reponse = $.parseJSON(reject.responseText);
                    jQuery.each(reponse.errors, function (key, value) {
                        toastr.error(value);
                    });
                }
            }
        });
        m.preventDefault();
    });
});
$(document).ready(function () {
    $("#updateForm").submit(function (m) {
        var url = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#btnSubmit').addClass('kt-spinner');
                $('#btnSubmit').attr('disabled', 'true');
            },
            complete: function () {
                $('#btnSubmit').removeClass('kt-spinner');
                $('#btnSubmit').removeAttr('disabled');

            },
            success: function (response) {
                if (response.errors) {
                    jQuery.each(response.errors, function (key, value) {
                        toastr.error(value);
                    });
                } else {
                    toastr.success('Updated.');
                    $('#updateForm').trigger("reset");
                    $('#modal-update-category').modal("hide");
                    $('.table-responsive').html(response);


                }
                window.location.href = "/question"
            },
            error: function (reject) {
                if (reject.status === 422) {
                    var reponse = $.parseJSON(reject.responseText);
                    jQuery.each(reponse.errors, function (key, value) {
                        toastr.error(value);
                    });
                }
            }
        });
        m.preventDefault();
    });
});



$(document).on('click', '.delete', function (e) {
    var url = $(this).attr('href');
    page = $(this).is("a") ? $(this).attr('href').split('page=')[1] : "";

    var token = $("meta[name='csrf-token']").attr("content");
    e.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token,
                    "page": page,
                },
            }).done(function (data) {
                if (data.errors) {
                    jQuery.each(data.errors, function (key, value) {
                        toastr.error(value);
                    });
                } else {
                    toastr.success('Deleted.');
                    $('.table-responsive').html(data);
                }
            })
        }
    })
});
$(document).on('change', '.specialization', function (e) {

    let specialist_id = $(this).val();
    $('#sub_specialist_id option').addClass('d-none')
    $('#sub_specialist_id .'+specialist_id).removeClass('d-none')
    // $.ajax({
    //     type: "GET",
    //     url: '/get/sub-specialization',
    //     data: {
    //         'specialist_id': $(this).val(),
    //     },
    //     beforeSend: function () {
    //     },
    //     complete: function () {
    //     },
    //     success: function (response) {
    //         $('.sub-specialization').html(response);
    //     },
    //     error: function (reject) {
    //     }
    // });

});



var page = 1;
$(document).on('click', '.pagination a , #searchBtn', function (e) {
    page = $(this).is("a") ? $(this).attr('href').split('page=')[1] : "";
    e.preventDefault();
    $.ajax({
        dataType: 'html',
        url: '/question',
        data: {
            "page": $(this).is("a") ? $(this).attr('href').split('page=')[1] : "",
            "question": $("#question").val(),
            "specialist_id": $("#specialist_id").val(),
            "sub_specialist_id": $("#sub_specialist_id").val(),
            "is_active": $("#is_active").val(),
        },
        success: function (data) {
            $('.table-responsive').html(data);

        }
    });
});
$(document).on('click', '#Resetsearch', function (e) {
    page = $(this).is("a") ? $(this).attr('href').split('page=')[1] : "";
    $.ajax({
        dataType: 'html',
        url: '/question',
        data: {
            "page": $(this).is("a") ? $(this).attr('href').split('page=')[1] : "",
        },
        success: function (data) {
            $('.table-responsive').html(data);

        }
    });
});



