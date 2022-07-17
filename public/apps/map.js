$(function() {
    // map
    var map = L.map("map").setView([-7.977014, 112.634056], 14);
    var osm = L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }
    );
    satellite = L.tileLayer(
        "http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}", {
            attribution: "google",
            maxZoom: 18,
        }
    );
    map.addLayer(osm);

    var baseLayers = [{
            name: "OpenStreetMap",
            layer: osm,
        },
        {
            name: "GoogleSatellite",
            layer: satellite,
        },
    ];

    var panelLayers = new L.Control.PanelLayers(baseLayers);
    map.addControl(panelLayers);

    // line kmz
    $.ajax({
        type: "GET",
        url: "/peta/drainase/2022",
        dataType: "JSON",
        success: function(response) {
            for (i = 0; i < response.data.length; i++) {
                var kmz = L.kmzLayer().addTo(map);
                kmz.load(`/storage/kmz/${response.data[i].file_kmz}`);
            }
        },
        error: function(response) {
            alertify.notify("Terjadi kesalahan!", "error", 3, function() {
                location.reload();
            });
        },
    });
});
