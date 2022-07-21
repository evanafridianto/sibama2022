$(function() {
    $("#kecamatan-form").submit(function(e) {
        loader();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/datamaster/kecamatan/store",
            data: formData,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    alertify.notify(
                        "Data berhasil disimpan!",
                        "success",
                        2,
                        function() {
                            location.reload();
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
            error: function(err) {
                alertify.notify("Terjadi kesalahan!", "error", 2, function() {
                    location.reload();
                });
            },
        });
        e.preventDefault();
    });
});
