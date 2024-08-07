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
                    window.location.href = "/subscribe-trainee"
                }
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
    $("#createForm").submit(function (m) {
        $.ajax({
            type: "POST",
            url: "/subscribe-trainee",
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
                    window.location.href = "/subscribe-trainee"
                }
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
var page = 1;
$('body').on('click', '.pagination a , #searchBtn', function (e) {
    page = $(this).is("a") ? $(this).attr('href').split('page=')[1] : "";
    e.preventDefault();
    $.ajax({
        dataType: 'html',
        url: '/subscribe-trainee',
        data: {
            "page": $(this).is("a") ? $(this).attr('href').split('page=')[1] : "",
            "trainee_id": $("#trainee_id").val(),
            "package_id": $("#package_id").val(),
            "active": $("#is_active").val(),
            "payment": $("#payment").val(),
            "is_paid": $("#is_paid").val(),
            "package_type": $("#package_type").val(),
        },


        success: function (data) {
            $('.table-responsive').html(data);

        }
    });
});

$(document).on('click', '#ResetSearch', function (e) {
    page = $(this).is("a") ? $(this).attr('href').split('page=')[1] : "";

    $.ajax({
        dataType: 'html',
        url: '/subscribe-trainee',
        data: {
            "page": $(this).is("a") ? $(this).attr('href').split('page=')[1] : "",
        },
        success: function (data) {
            $('.table-responsive').html(data);
        }
    });
});
$(document).on('change', '.amount', function (e) {

//alert($('#packageId').val());
    if ($('#package_type').val() != null && $('#packageId').val() != null) {
        $.ajax({
            type: "GET",
            url: '/get/subscribe-cost',
            data: {
                'package_type': $('#package_type').val(),
                'package_id': $('#packageId').val(),
            },
            beforeSend: function () {
            },
            complete: function () {
            },
            success: function (response) {
                $('#amount').val(response);
            },
            error: function (reject) {
            }
        });
    }

});
$(document).on('change', ['.startDate', '.amount'], function (e) {
    if ($('#package_type').val() != null && $('.startDate').val() != '') {
        $.ajax({
            type: "GET",
            url: '/get/subscribe-end-date',
            data: {
                'package_type': $('#package_type').val(),
                'start_date': $(this).val(),
            },
            beforeSend: function () {
            },
            complete: function () {
            },
            success: function (response) {
                $('#endDate').val(response);
            },
            error: function (reject) {
            }
        });
    }

});
$(document).on('click','.show_invoice',function (event) {
    alert('test')
    let invoice_url = $(this).data('invoice_url');
    let img = "<img height='500' src=storage/"+invoice_url+">"
    console.log(invoice_url);
    $('#modal_content').html(img);
});
