/* City button */

$(".city #city-list > li").click(function() {
    var cityID   = $(this).attr("data-city-id");
    var cityName = $(this).children("a").html();
    
    $("#city-button").attr("data-city-id", cityID);
    $("#city-button > .c-button-caption > .c-button-text").html(cityName);
    
    var coords = eval("(" + $(this).attr("data-city-coords") + ")");    
    var m = new Map("map");
    m.showMap(coords.latitude, coords.longitude, 10);
});



