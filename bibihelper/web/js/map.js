/* Map */

function Map(mapid)
{
    this.map = null;
    this.mapid = mapid;
    this.lat = 0;
    this.lng = 0;
    this.infoWindowTitle = "Ваше местоположение";
    this.infoWinfowContent = "Широта: " + this.lat + ", Долгота: " + this.lng;
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
    var marker = new google.maps.Marker(markerOptions);
    var infoWindowOptions = {
        content: this.infoWinfowContent,
        position: coords
    };
    var infoWindow = new google.maps.InfoWindow(infoWindowOptions);
    google.maps.event.addListener(marker, "click", function () {
        infoWindow.open(this.map);
    });
};






