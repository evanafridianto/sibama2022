$(function() {
    $("#drainase-form").submit(function(e) {
        loader();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "/drainase/2020/store",
            data: formData,
            contentType: false,
            processData: false,
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
            },
            error: function(err) {
                alertify.notify("Terjadi kesalahan!", "error", 2, function() {
                    location.reload();
                });
            },
        });
        e.preventDefault();
    });

    $('[name="dimensi"]').change(function(e) {
        e.preventDefault();
        readURL(this);
        var fileName = e.target.files[0].name;
        $('[name="nama_file_dimensi"]').val(fileName);
        $('[name="nama_file_dimensi "]').next().empty();
    });
    $('[name="foto"]').change(function(e) {
        e.preventDefault();
        readURL2(this);
        var fileName = e.target.files[0].name;
        $('[name="nama_file_foto"]').val(fileName);
        $('[name="nama_file_foto "]').next().empty();
    });
});
