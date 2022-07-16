$("#user-form").submit(function(e) {
    loader();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var formData = $(this).serialize();
    $.ajax({
        url: "/profil/store",
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data) {
            if (data.status) {
                alertify.notify(
                    "Profil berhasil diupdate!",
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

$(function() {
    $(".text-danger").empty();
    // set password
    $("#change-password").click(function() {
        $("#toggle-password").toggle(function() {
            if ($("#toggle-password").is(":visible")) {
                $(this).append(
                    '<input type="hidden" name="new-password"></input>'
                );
                $("#change-password").text("Batal");
            } else {
                $('[name="new-password"]').remove();
                $("#change-password").text("Ganti Password");
                $(".text-danger").empty();
            }
        });
    });
});
