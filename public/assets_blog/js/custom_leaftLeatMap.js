class Custom_leaftLeatMap {

    constructor() {


    }

    ShowMap(lat = '27.219824', lng = '56.338504', type = 'new', readOnlyVar = false) {
        var marker;
        var map = L.map('map').setView([lat, lng], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        if (lat != null) {
            AddMarker(lat, lng);
        }


        function AddMarker(lat, lng) {
            if (!readOnlyVar) {
                var lat_map_doc = document.getElementById('lat_map').value = lat;
                var lang_map_doc = document.getElementById('lang_map').value = lng;
            }

            if (marker) { // check
                map.removeLayer(marker); // remove
            }

            marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(type == 'new' ? ' ' : ' ')
                .openPopup();
        }

        map.on('click', function (e) {
            if (!readOnlyVar) {
                AddMarker(e.latlng.lat, e.latlng.lng);
            }

        });
        if (type == 'new') {
            if (!readOnlyVar) {
                navigator.geolocation.getCurrentPosition(function (location) {
                    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
                    AddMarker(latlng.lat, latlng.lng);
                    map.flyTo(latlng, 15);

                });
            }


        }

    }

    ShowMapCustomers(lat = '27.219824', lng = '56.338504') {

    }


}
