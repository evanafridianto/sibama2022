$(function() {
    if ($('[name="route"]').val() === "jalan.edit") {
        $.ajax({
            type: "GET",
            url: "",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="kecamatan"]')
                    .val(data.kecamatan_id)
                    .trigger("change");
                $('[name="kelurahan"]')
                    .val(data.kelurahan_id)
                    .trigger("change");
                $('[name="id_kelurahan"]').val(data.kelurahan_id);
            },
        });
    }

    $('[name="kecamatan"]').change(function(e) {
        var kecamatan_id = $(this).val();
        $.ajax({
            type: "GET",
            url: `/datamaster/kelurahan/kecamatanId/${kecamatan_id}`,
            dataType: "JSON",
            async: true,
            success: function(response) {
                $('[name="kelurahan"]').empty();
                $.each(response, function(key, value) {
                    if ($('[name="id_kelurahan"]').val() == value.id) {
                        //update selected
                        $('[name="kelurahan"]')
                            .append(
                                '<option selected="selected" value="' +
                                value.id +
                                '">' +
                                value.nama +
                                "</option>"
                            )
                            .trigger("change");
                    } else {
                        $('[name="kelurahan"]').append(
                            '<option value="' +
                            value.id +
                            '">' +
                            value.nama +
                            "</option>"
                        );
                    }
                });
            },
        });
        e.preventDefault();
    });

    $("#jalan-form").submit(function(e) {
        loader();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/datamaster/jalan/store",
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
                        if (
                            $('[name="' + key + '"]')
                            .next()
                            .is("small")
                        ) {
                            $('[name="' + key + '"]')
                                .next()
                                .text(value);
                        } else if (key == "kelurahan") {
                            $('[name="' + key + '"]')
                                .parent()
                                .next()
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
                    // location.reload();
                });
            },
        });
        e.preventDefault();
    });
});
