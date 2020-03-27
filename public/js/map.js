var map;
var placemark;
var collection;
var latitude = document.getElementById('latitude');
var longitude = document.getElementById('longitude');
ymaps.ready(function() {
    if (latitude.value.length && longitude.value.length) {
        map = new ymaps.Map('map', {
            center: [latitude.value, longitude.value],
            zoom: 16,
            controls: ['fullscreenControl', 'zoomControl', 'searchControl']
        });
    } else {
        map = new ymaps.Map('map', {
            center: [48.4735871, 135.08184],
            zoom: 13,
            controls: ['fullscreenControl', 'zoomControl', 'searchControl']
        });
    }

    var search = map.controls.get('searchControl');
    search.options.set('noPopup', true);
    search.events.add('resultselect', function () {
        address = search.state.get('results')[search.state.get('currentIndex')];
        coords = address.geometry.getCoordinates();
        collection.removeAll();
        latitude.value = coords[0];
        longitude.value = coords[1];
    }, this);

    collection = new ymaps.GeoObjectCollection();
    map.geoObjects.add(collection);
    if (latitude.value.length && longitude.value.length) {
        placemark = new ymaps.Placemark([latitude.value, longitude.value]);
        collection.add(placemark);
    }

    map.events.add('click', function(e) {
        var coords = e.get('coords');
        placemark = new ymaps.Placemark([coords[0], coords[1]]);
        collection.removeAll();
        collection.add(placemark);
        latitude.value = coords[0];
        longitude.value = coords[1];
    });
});