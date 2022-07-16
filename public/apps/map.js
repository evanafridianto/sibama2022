$(function() {
    var map = L.map("map").setView([-7.977014, 112.634056], 14);

    var tiles = L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }
    ).addTo(map);
});
