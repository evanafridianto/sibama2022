$("#r24-form").submit(function(e) {
    loader();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var formData = $(this).serialize();
    $.ajax({
        url: "/r24/store",
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data) {
            if (data.status) {
                alertify.notify(
                    "R24 berhasil diupdate!",
                    "success",
                    2,
                    function() {
                        location.replace(data.redirect);
                    }
                );
            } else {
                $.each(data.error, function(key, value) {
                    $('[name="' + key + '"]')
                        .next()
                        .text(value);
                });
            }
        },
        error: function(response) {
            alertify.notify("Terjadi kesalahan!", "error", 2, function() {
                location.reload();
            });
        },
    });
    e.preventDefault();
});
