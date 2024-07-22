
$(document).ready(function () {
    if ($('#no_limit_for_quiz').is(':checked')) {
        $('#num_available_quiz').val(0);
        $('#num_available_quiz').attr('disabled', 'disabled');
    }

    if ($('#no_limit_for_question').is(':checked')) {
        $('#num_available_question').val(0);
        $('#num_available_question').attr('disabled', 'disabled');
    }
    $('body').on('change', '#no_limit_for_quiz', function () {
        if ($(this).is(':checked')) {
            $('#num_available_quiz').val(0);
            $('#num_available_quiz').attr('disabled', 'disabled');
        } else {
            $('#num_available_quiz').removeAttr('disabled');
        }
    });
    $('body').on('change', '#no_limit_for_question', function () {
        if ($(this).is(':checked')) {
            $('#num_available_question').val(0);
            $('#num_available_question').attr('disabled', 'disabled');
        } else {
            $('#num_available_question').removeAttr('disabled');
        }
    });

    $('.add-button').click(function (e) {
        // Clone the row
        e.preventDefault();
        var newRow = $('.specialist:eq(0)').clone();
        // Append the cloned row
        $('.for_specific_specialities').append(newRow);
        // Change the button text to remove
        newRow.find('.add-button').text('Remove')
            .removeClass('add-button').addClass('remove-button btn btn-danger mb-2');
    });

    // Remove button click event
    $(document).on('click', '.remove-button', function (e) {
        // Remove the row
        e.preventDefault();

        $(this).closest('.specialist').remove();
    });

    $("#createForm").submit(function (m) {
        $.ajax({
            type: "POST",
            url: "/package",
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
                window.location.href = "/package"

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
                window.location.href = "/package"
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
                console.log(data.errors);
                if (data.errors) {
                    jQuery.each(data.errors, function (key, value) {
                        toastr.error(value);
                    });
                } else {
                    toastr.success('Deleted.');
                    $('.table-responsive').html(data);
                }
            }).catch(function (data) {
                console.log('catch', error);
                toastr.error(error);
            });
        }
    }).catch((error) => {

    });
});



var page = 1;
$('body').on('click', '.pagination a , #searchBtn', function (e) {
    page = $(this).is("a") ? $(this).attr('href').split('page=')[1] : "";
    e.preventDefault();
    $.ajax({
        dataType: 'html',
        url: '/package',
        data: {
            "page": $(this).is("a") ? $(this).attr('href').split('page=')[1] : "",
            "name": $("#name").val(),
            "is_active": $("#is_active").val(),
        },
        success: function (data) {
            $('.table-responsive').html(data);

        }
    });
});


