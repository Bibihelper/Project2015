var map;

function displayLocation(position)
{
    showMap(position.coords);
}

function displayError(error)
{
    errorTypes = {
        0: "Unknown error",
        1: "Permission denied by user",
        2: "Position is not available",
        3: "Request limited timed out"
    };
    var errorMessage = errorTypes[error.code];
    if (error.code == 0 || error.code == 2)
        errorMessage = errorMessage + " " + error.message;
    var div = document.getElementById("location");
    div.innerHTML = errorMessage;
}

function showMap(coords)
{
    var googleLatAndLong = new google.maps.LatLng(coords.latitude, coords.longitude);
    
    var mapOptions = {
        zoom: 10,
        center: googleLatAndLong,
        mapTypeID: google.maps.MapTypeId.ROADMAP
    };
    
    var mapDiv = document.getElementById("map");
    map = new google.maps.Map(mapDiv, mapOptions);
  
    var title = "Ваше местоположение";
    var content = "Широта: " + coords.latitude + ", Долгота: " + coords.longitude;
    
    addMarker(map, googleLatAndLong, title, content);
}

function addMarker(map, latlong, title, content)
{
    var markerOptions = {
        position: latlong,
        map: map,
        title: title,
        clickable: true
    };
    var marker = new google.maps.Marker(markerOptions);
  
    var infoWindowOptions = {
        content: content,
        position: latlong
    };
    var infoWindow = new google.maps.InfoWindow(infoWindowOptions);
    google.maps.event.addListener(marker, "click", function () {
        infoWindow.open(map);
    });
}



