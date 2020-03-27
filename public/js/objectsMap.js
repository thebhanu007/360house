var map;
var placemark;
var collection;
ymaps.ready(function() {
    ymaps.geolocation.get().then(function(res) {
        map = new ymaps.Map('map', {
            //center: [48.47849499458924, 135.07239862426752],
            center: [res.geoObjects.position[0], res.geoObjects.position[1]],
            zoom: 14
        });

        collection = new ymaps.GeoObjectCollection();
        map.geoObjects.add(collection);

        var updateMap = function() {
            collection.removeAll();
            bounds = map.getBounds();
            latitude = bounds[0][0] + ';' + bounds[1][0];
            longitude = bounds[0][1] + ';' + bounds[1][1];
            $.post('/mapobjects', { latitude: latitude, longitude: longitude}, function(response) {
                $.each(response, function(id, values) {
                    placemark = new ymaps.Placemark([values.latitude, values.longitude], { 
                        balloonContentBody: '<a href="' + values.url + '" style="color: inherit;" target="_blank"><img src="' + values.thumb + '" style="float: left; max-height: 80px; max-width: 80px; margin-right: 10px;"><span style="float: left; width: 200px;"><span style="display: block">' + values.full_name + '</span><b>' + values.print_price + '</b><span style="font-size: 12px; color: #777; display: block;">' + values.full_address + '</span></span></a>'
                    });
                    placemark.description = response.full_name;
                    collection.add(placemark);
                });
            });
        };
        updateMap();

        map.events.add('actionend', function (e) {
            console.log(e);
            updateMap();
        });
    });
});