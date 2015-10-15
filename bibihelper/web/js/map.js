/* Marker cluster styles */

var styles = [[{
        url: 'js-marker-cluster/images/people35.png',
        height: 35,
        width: 35,
        anchor: [16, 0],
        textColor: '#ff00ff',
        textSize: 10
    }, {
        url: 'js-marker-cluster/images/people45.png',
        height: 45,
        width: 45,
        anchor: [24, 0],
        textColor: '#ff0000',
        textSize: 11
    }, {
        url: 'js-marker-cluster/images/people55.png',
        height: 55,
        width: 55,
        anchor: [32, 0],
        textColor: '#ffffff',
        textSize: 12
    }], [{
        url: 'js-marker-cluster/images/conv30.png',
        height: 27,
        width: 30,
        anchor: [3, 0],
        textColor: '#ff00ff',
        textSize: 10
    }, {
        url: 'js-marker-cluster/images/conv40.png',
        height: 36,
        width: 40,
        anchor: [6, 0],
        textColor: '#ff0000',
        textSize: 11
    }, {
        url: 'js-marker-cluster/images/conv50.png',
        width: 50,
        height: 45,
        anchor: [8, 0],
        textSize: 12
    }], [{
        url: 'js-marker-cluster/images/heart30.png',
        height: 26,
        width: 30,
        anchor: [4, 0],
        textColor: '#ff00ff',
        textSize: 10
    }, {
        url: 'js-marker-cluster/images/heart40.png',
        height: 35,
        width: 40,
        anchor: [8, 0],
        textColor: '#ff0000',
        textSize: 11
    }, {
        url: 'js-marker-cluster/images/heart50.png',
        width: 50,
        height: 44,
        anchor: [12, 0],
        textSize: 12
}]];

/* Google map */

function googleMap(mapid)
{
// show map props
    this.mapid = mapid;   
    this.lat = null;
    this.lng = null;
    this.zoom = null;
    this.map = null;
    this.center = null;
    this.mapProp = null;
    
// marker cluster props    
    this.maxZoom = null;
    this.gridSize = null;
    this.style = null;
    this.markers = [];
    this.markerClusterer = null;
    
// moveable marker
    this.mMarker = null;
    this.mLat = null;
    this.mLng = null;
    this.mIcon = null;
}

googleMap.prototype.showMap = function(lat, lng, zoom)
{
    this.lat = lat || 63.31268278;
    this.lng = lng || 103.42773438;
    this.zoom = zoom || 3;
    this.center = new google.maps.LatLng(this.lat, this.lng);
    
    this.mapProp = {
        center: this.center,
        zoom: this.zoom,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    this.map = new google.maps.Map(document.getElementById(this.mapid), this.mapProp);
};

googleMap.prototype.showMarker = function(lat, lng, icon, moveable)
{
    lat = lat || 63.31268278;
    lng = lng || 103.42773438;
    icon = icon || "/images/pointer-blue.png";
    
    var location = new google.maps.LatLng(lat, lng);
    var infoWindowTitle = "Местоположение";
    var infoWinfowContent = "Широта: " + lat + "<br>Долгота: " + lng;

    var marker = new google.maps.Marker({
        position: location,
        map: this.map,
        title: infoWindowTitle,
        clickable: true
    });

    var infoWindow = new google.maps.InfoWindow({
        content: infoWinfowContent,
        position: location
    });
    
    google.maps.event.addListener(marker, "click", function () {
        infoWindow.open(this.map);
    });
    
    marker.setIcon(icon);
    
    if (moveable) {
        this.mMarker = marker;
        this.mLat = lat;
        this.mLng = lng
        this.mIcon = icon;
    } else {
        this.markers.push(marker);
    }
};

googleMap.prototype.hideMarker = function()
{
    if (this.mMarker) {
        this.mMarker.setMap(null);
        this.mMarker = null;
    }
};

googleMap.prototype.showMoveableMarker = function(lat, lng, icon)
{
    var m = this;
    m.showMarker(lat, lng, icon, true);
	google.maps.event.addListener(m.map, 'click', function(event) {
        m.moveMarker(event.latLng);
        m.saveCoords("/private-room/save-coords/");
	});
};

googleMap.prototype.moveMarker = function(latLng)
{
    this.hideMarker();
    this.mLat = latLng.lat();
    this.mLng = latLng.lng();
    this.showMarker(this.mLat, this.mLng, this.mIcon);    
};

googleMap.prototype.saveCoords = function(url)
{
    $.ajax({
        url: url,
        method: "POST",
        data: { latitude: this.lat, longitude: this.lng },
        dataType: "json"
    });
};

googleMap.prototype.markerClusterInit = function(maxZoom, gridSize, style)
{
    this.maxZoom = maxZoom || null;
    this.gridSize = gridSize || null;
    this.style = style || null;
    
    this.markerClusterer = new MarkerClusterer(this.map, this.markers, {
        maxZoom: this.maxZoom,
        gridSize: this.gridSize,
        styles: styles[this.style]
    });
}

googleMap.prototype.placeMarkers = function(coords, icon)
{
    icon = icon || "/images/pointer-blue.png";

    for (var i = 0; i < coords.length; i++) {
        var lat = coords[i].latitude;
        var lng = coords[i].longitude;
        
        this.showMarker(lat, lng, icon);
    }
}

googleMap.prototype.clearMarkers = function()
{
    for (var i = 0; i < this.markers.length; i++) {
        this.markers[i].setMap(null);
        this.markers[i] = null;
    }
    
    this.markers.length = 0;
    
    if (this.markerClusterer) {
        this.markerClusterer.clearMarkers();
        this.markerClusterer = null;
    }
}

