$(function() {
    $("input, select, textarea").bind("keyup change input click", function() {
        if ($(this).next().is("small")) {
            $(this).next(".text-danger").empty();
        } else if ($(this).parent().next().is("small")) {
            $(this).parent().next(".text-danger").empty();
        } else {
            $(this).parent().next().next(".text-danger").empty();
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
            $("#content-body").waitMe({
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
            $("#content-body").waitMe("hide");
        },
        error: function(response) {
            $("#content-body").waitMe("hide");
        },
    });
}

alertify.defaults.transition = "pulse";
alertify.defaults.theme.ok = "btn btn-primary";
alertify.defaults.theme.cancel = "btn btn-danger";
alertify.set("notifier", "position", "top-right");

// img preview
function readURL(input) {
    for (var i = 0; i < input.files.length; i++) {
        if (input.files[i]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#img-preview").find("img").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[i]);
        }
    }
}
// img preview2
function readURL2(input) {
    for (var i = 0; i < input.files.length; i++) {
        if (input.files[i]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#img-preview2").find("img").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[i]);
        }
    }
}
