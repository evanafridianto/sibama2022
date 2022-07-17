$(function() {
    $("input, select, textarea").bind("keyup change input click", function() {
        if ($(this).next().is("small")) {
            $(this).next(".text-danger").empty();
        } else {
            $(this).parent().next(".text-danger").empty();
        }
    });
});

function logout() {
    alertify
        .confirm(
            "Konfirmasi!",
            "Anda yakin ingin Log Out?",
            function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
                $.ajax({
                    url: "/logout",
                    data: $("#logout").serialize(),
                    type: "POST",
                    success: function(data) {
                        window.location.href = "/login";
                    },
                    error: function(response) {
                        alertify.notify(
                            "Terjadi kesalahan!",
                            "error",
                            3,
                            function() {
                                location.reload();
                            }
                        );
                    },
                });
            },
            function() {}
        )
        .set("labels", { ok: "Log Out", cancel: "Batal" });
}

// loader button
function loader() {
    $.ajax({
        beforeSend: function() {
            $("body").waitMe({
                effect: "roundBounce",
                text: "<span class='text-secondary'>Loading...</span>",
                bg: "rgba(255,255,255,0.7)",
                color: "#6673fd",
                maxSize: "",
                waitTime: -1,
                textPos: "vertical",
                fontSize: "",
                source: "",
                onClose: function() {},
            });
        },
        complete: function(data) {
            $("body").waitMe("hide");
        },
        error: function(response) {
            $("body").waitMe("hide");
        },
    });
}

alertify.defaults.transition = "pulse";
alertify.defaults.theme.ok = "btn btn-primary";
alertify.defaults.theme.cancel = "btn btn-danger";
alertify.set("notifier", "position", "top-right");
