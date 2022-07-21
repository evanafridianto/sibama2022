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

    var baseballIcon = L.icon({
        iconUrl: "http://leafletjs.com/examples/baseball-marker.png",
        iconSize: [32, 37],
        iconAnchor: [16, 37],
        popupAnchor: [0, -28],
    });

    // line titik genangan
    var overLayers = [{
        name: "Titik Genangan&nbsp;",
        icon: '<i class="la la-area-chart"></i>',
        layer: new L.GeoJSON.AJAX("/api/layer/genangan", {
            style: function(feature) {
                return {
                    // iconAnchor: [8, 8],
                    iconAnchor: [22, 94],
                    iconUrl: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAA7VBMVEUAAAA/X39UVHFMZn9NXnRPX3RMW3VPXXNOXHJOXXNNXHNOXXFPXHNNXXFPXHFOW3NPXHNPXXJPXXFPXXNNXXFNW3NOXHJPW25PXXNRX3NSYHVSYHZ0fIx1fo13gI95hJR6go96g5B7hpZ8hZV9hpZ9h5d/iZiBi5ucoquepa+fpbGhqbSiqbXNbm7Ob2/OcHDOcXHOcnLPdHTQdXXWiIjXiorXjIzenp7eoKDgpKTgpaXgpqbks7TktLTktbXnubnr2drr5+nr6Ons29vs29zs6Ors6ert6uvt6uzu6uz18fH18fL68PD++/v+/Pw8gTaQAAAAFnRSTlMACAkKLjAylJWWmJmdv8HD19ja2/n6GaRWtgAAAMxJREFUGBkFwctqwkAUgOH/nMnVzuDGFhRKKVjf/226cKWbQgNVkphMzFz6fQJQlY0S/boCAqa1AMAwJwRjW4wtcxgS05gEa3HHOYipzxP9ZKot9tR5ZfIff7FetMQcf4tDVexNd1IKbbA+7S59f9mlZGmMVVdpXN+3gwh+RiGLAjkDGTQSjHfhes3OV0+CkXrdL/4gzVunxQ+DYZNvn+Mg6aav35GH8OJS/SUrVTw/9e4FtRvypsbPwmPMAto6AOC+ZASgLBpDmGMA/gHW2Vtk8HXNjQAAAABJRU5ErkJggg==",
                };
            },
            onEachFeature: onEachFeature,
        }).addTo(map),
    }, ];

    var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers);
    map.addControl(panelLayers);
});

function onEachFeature(feature, layer) {
    if (feature.properties) {
        var content = `<h4>${feature.properties.nama_jalan}</h4><iframe src="//stream.cctv.malangkota.go.id:/WebRTCApp/play.html?name=${feature.properties.stream_id}" title="description"></iframe>`;
        layer.bindPopup(content, {
            maxHeight: 1200,
            maxWidth: 800,
        });
    }
}
