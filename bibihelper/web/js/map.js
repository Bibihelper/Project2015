/* Map */

function Map(mapid)
{
    this.map = null;
    this.mapid = mapid;
    this.lat = 0;
    this.lng = 0;
    this.infoWindowTitle = "Ваше местоположение";
    this.infoWinfowContent = "";
    this.marker = null;
}

Map.prototype.showMap = function(lat, lng, zoom)
{
    this.lat = lat || 0;
    this.lng = lng || 0;

    if (this.lat !== 0 && this.lng !== 0) {
        zoom = zoom || 3;
        var coords = new google.maps.LatLng(this.lat, this.lng);
        var mapOptions = {
            zoom: zoom,
            center: coords,
            mapTypeID: google.maps.MapTypeId.ROADMAP
        };
        this.map = new google.maps.Map(document.getElementById(this.mapid), mapOptions);
    }
};

Map.prototype.showMarker = function()
{
    var coords = new google.maps.LatLng(this.lat, this.lng);
    var markerOptions = {
        position: coords,
        map: this.map,
        title: this.infoWindowTitle,
        clickable: true
    };
    this.marker = new google.maps.Marker(markerOptions);

    this.infoWinfowContent = "Широта: " + this.lat + ",<br>Долгота: " + this.lng;
    var infoWindowOptions = {
        content: this.infoWinfowContent,
        position: coords
    };
    var infoWindow = new google.maps.InfoWindow(infoWindowOptions);
    
    google.maps.event.addListener(this.marker, "click", function () {
        infoWindow.open(this.map);
    });
};

Map.prototype.hideMarker = function()
{
    if (this.marker) {
        this.marker.setMap(null);
        this.marker = null;
    }
};

Map.prototype.showMoveableMarker = function()
{
    var m = this;
    m.showMarker();
	google.maps.event.addListener(m.map, 'click', function(event) {
        m.moveMarker(event.latLng);
        m.saveCoords("/private-room/save-coords/");
	});
};

Map.prototype.moveMarker = function(latLng)
{
    this.hideMarker();
    this.lat = latLng.H || latLng.J;
    this.lng = latLng.L || latLng.M;
    this.showMarker();    
};

Map.prototype.saveCoords = function(url)
{
    $.ajax({
        url: url,
        method: "POST",
        data: { latitude: this.lat, longitude: this.lng },
        dataType: "json"
    });
};












