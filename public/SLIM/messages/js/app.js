
$(document).on('click', '.showMessage', function(e) {
    e.preventDefault();
    $('.MessageContent').html($(this).attr('message'));
});

$(document).on('click', '.delete', function(e) {
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
            }).done(function(data) {
                if (data.errors) {
                    jQuery.each(data.errors, function(key, value) {
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



$('body').on('click', '.pagination a , #searchBtn', function (e) {
    e.preventDefault();
    $.ajax({
        dataType: 'html',
        url: '/message',
        data: {
            "page": $(this).is("a") ? $(this).attr('href').split('page=')[1] : "",
            "name": $("#name").val(),
            "email": $("#email").val(),
            "phone": $("#phone").val(),
            "is_read": $("#status").val(),
        },
        success: function (data) {
            $('.table-responsive').html(data);

        }
    });
});



$(document).on('click', '.read', function(e) {
    page = $(this).is("a") ? $(this).attr('href').split('page=')[1] : "";
    e.preventDefault();
    $.ajax({
        dataType: 'html',
        url: '/read-unread',
        data: {
            "page": page,
            "message_id": ($(this).attr('id')),
        },
        success: function (data) {
            $('.table-responsive').html(data);

        }
    });



});
