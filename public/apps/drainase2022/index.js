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
