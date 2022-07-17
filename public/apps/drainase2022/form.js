$(function() {
    $("#drainase2022-form").submit(function(e) {
        loader();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "/datamaster/drainase2022/store",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    alertify.notify(
                        "Data berhasil diimpor!",
                        "success",
                        2,
                        function() {
                            location.reload();
                        }
                    );
                } else {
                    $.each(data.error, function(key, value) {
                        if (
                            $('[name="' + key + '"]')
                            .next()
                            .is("small")
                        ) {
                            $('[name="' + key + '"]')
                                .next()
                                .text(value);
                        } else {
                            $('[name="' + key + '"]')
                                .parent()
                                .next()
                                .text(value);
                        }
                    });
                }
                console.log(data);
            },
            error: function(err) {
                console.log(err);
                alertify.notify("Terjadi kesalahan!", "error", 2, function() {
                    location.reload();
                });
            },
        });
        e.preventDefault();
    });
});