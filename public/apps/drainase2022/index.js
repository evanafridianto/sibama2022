// datatable
var table;
$(function() {
    table = $("#datatable").DataTable({
        order: [],
        processing: true,
        serverSide: true,
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        language: {
            searchPlaceholder: "Search...",
            sSearch: "",
            // lengthMenu: "_MENU_ items/page",
        },
        ajax: "",
        columns: [{
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "kode_saluran",
                name: "kode_saluran",
                className: "align-middle",
            },
            {
                data: "lokasi",
                name: "lokasi",
                className: "align-middle",
            },
            {
                data: "sisi",
                name: "sisi",
                className: "align-middle",
            },
            {
                data: "panjang",
                name: "panjang",
                className: "align-middle",
            },
            {
                data: "tinggi",
                name: "tinggi",
                className: "align-middle",
            },
            {
                data: "kondisi_fisik",
                name: "kondisi_fisik",
                className: "align-middle",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                className: "align-middle text-center",
            },
        ],
    });
});

// table reload
function reloadTable() {
    table.ajax.reload(null, false);
}

// destroy
function destroy(id) {
    alertify
        .confirm(
            "Konfirmasi!",
            "Anda yakin ingin menghapus data ini?",
            function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    url: "/datamaster/drainase2022/destroy/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            alertify.notify(
                                "Data berhasil dihapus!",
                                "success",
                                2
                            );
                            reloadTable();
                        }
                    },
                    error: function(response) {
                        alertify.notify(
                            "Terjadi kesalahan!",
                            "error",
                            2,
                            function() {
                                location.reload();
                            }
                        );
                    },
                });
            },
            function() {}
        )
        .set("labels", { ok: "Hapus", cancel: "Batal" });
}

function exportXlsx() {
    loader();
    $.ajax({
        type: "GET",
        url: "/datamaster/drainase2022/export",
        xhrFields: {
            responseType: "blob",
        },
        success: function(result) {
            // The actual download
            var blob = new Blob([result], {
                type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            });
            var link = document.createElement("a");
            link.href = window.URL.createObjectURL(blob);
            link.download = "Drainase2022.xlsx";
            document.body.appendChild(link);
            link.click();

            alertify.notify(
                "Data berhasil diekspor!",
                "success",
                2,
                function() {
                    reloadTable();
                }
            );
        },
        error: function(err) {
            alertify.notify("Terjadi kesalahan!", "error", 2, function() {
                location.reload();
            });
        },
    });
}

function importXlsx() {
    alertify.genericDialog ||
        alertify.dialog("genericDialog", function() {
            return {
                main: function(content) {
                    this.setContent(content);
                },
                setup: function() {
                    return {
                        focus: {
                            element: function() {
                                return this.elements.body.querySelector(
                                    this.get("selector")
                                );
                            },
                            select: true,
                        },
                        options: {
                            basic: true,
                            maximizable: false,
                            resizable: false,
                            padding: true,
                        },
                    };
                },
                settings: {
                    selector: undefined,
                },
            };
        });
    //force focusing password box
    alertify
        .genericDialog(
            '<form id="import-form"><div class="form-row"><div class="col-md-12 col-sm-12"><div class="form-group"><label>Upload File</label><input type="file" class="form-control" name="file_xlsx"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" /><small class="text-danger"></small></div></div></div><div class="btn-list"><button type="submit" class="btn btn-primary">Submit</button></div></form>'
        )
        .set("selector", 'input[type="file"]');

    $("#import-form").submit(function(e) {
        loader();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: "POST",
            url: "/datamaster/drainase2022/import",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $(".alertify").remove();
                    reloadTable();

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
}
