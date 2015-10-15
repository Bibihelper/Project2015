/* Index */

var srchActive = null;
var userLat = null;
var userLng = null;

$(document).ready(function() {
    ymaps.ready(initYandexMaps);

    iMap = new googleMap("map");
    iMap.showMap(userLat, userLng, 10);
    showMarkers(iMap);
    initSlider();
    
    var sl = $(".search-list");
    var he = $(sl).height();
    var lh = 28;
    
    $(sl).each(function (i, item) {
        var cc = $(item).children("li").length;
        var hh = cc * lh;
        if (hh < he) {
            $(item).height(hh);
        }
    });
    
    proceedUrl();
    srchActive = $(".search-simple");
});

// Карты Яндекса

function initYandexMaps() {
    var geolocation = ymaps.geolocation;
    geolocation.get({
        provider: 'yandex',
        mapStateAutoApply: true
    }).then(function (result) {
        userLat = result.geoObjects.position[0];
        userLng = result.geoObjects.position[1];
    });
}

// Переключение между формами простого и расширенного поиска

$("#search-ext-button").click(function() {
    $(".search-simple").hide("slow");
    $(".search-ext").show("slow");
    srchActive = $(".search-ext");
});

$("#search-simple-button").click(function() {
    $(".search-ext").hide("slow");
    $(".search-simple").show("slow");
    srchActive = $(".search-simple");
});

// Синхронизация чекбоксов на формах простого и расширенного поиска

$("#twfhr-checkbox-1").click(function() {
    document.getElementById("twfhr-checkbox-2").checked = this.checked;
});

$("#twfhr-checkbox-2").click(function() {
    document.getElementById("twfhr-checkbox-1").checked = this.checked;
});

// Кнопки выбора на формах

$(".search-list > li").click(function() {
    var dataID   = $(this).attr("data-id");
    var dataName = $(this).children("a").html();
    
    var button = $(this).parent("ul").parent("div").children("button");
    var text   = $(button).children("span.f-button-caption").children("span.f-button-text");
    var li     = $(this).siblings("li[data-id = \"" + $(button).attr("data-id") +"\"]");
    
    if (!$(this).hasClass("search-item-group")) {
        $(li)  .children("a").css("background-color", "#e8e6e6");
        $(this).children("a").css("background-color", "#d5eded");
    }
    
    if ($(button).hasClass("brand")) {
        button = $(".brand");
        $(button).each(function(i, item) {
            text   = $(item).children("span.f-button-caption").children("span.f-button-text");
            $(item).attr("data-id", dataID);
            $(text).html(dataName);
        });
        return true;
    }
    
    if ($(button).hasClass("wtype")) {
        button = $(".wtype");
        $(button).each(function(i, item) {
            text   = $(item).children("span.f-button-caption").children("span.f-button-text");
            $(item).attr("data-id", dataID);
            $(text).html(dataName);
        });
        return true;
    }
    
    $(button).attr("data-id", dataID);
    $(text).html(dataName);
});

/* All special offers button */

$(".special-offers-button").click(function() {
    window.location.href = "/special-offers/";
});

/* Search results arrows */

var ROW_HEIGHT = 105;

$("#srlist-arrow-d").click(function() {
    var v = $(".srlist");
    var i = $(v).attr("data-item") || 0;
    var l = $(v).children().length - 3;
    i++;
    if (i < l) {
        $(v).animate({top: -i * ROW_HEIGHT + "px"}).attr("data-item", i);
    }
    if (i === (l - 1)) {
        if ($(this).hasClass("srlist-arrow-down")) {
            $(this).removeClass("srlist-arrow-down");
            $(this).addClass("srlist-arrow-down-na");
        }
    }
    var a = $(".srlist-arrow-up-na");
    if ($(a) !== null) {
        $(a).removeClass("srlist-arrow-up-na");
        $(a).addClass("srlist-arrow-up");
    }
});

$("#srlist-arrow-u").click(function() {
    var v = $(".srlist");
    var i = $(v).attr("data-item") || 0;
    i--;
    if (i >= 0) {
        $(v).animate({top: -i * ROW_HEIGHT + "px"}).attr("data-item", i);
    }
    if (i === 0) {
        if ($(this).hasClass("srlist-arrow-up")) {
            $(this).removeClass("srlist-arrow-up");
            $(this).addClass("srlist-arrow-up-na");
        }
    }
    var a = $(".srlist-arrow-down-na");
    if ($(a) !== null) {
        $(a).removeClass("srlist-arrow-down-na");
        $(a).addClass("srlist-arrow-down");
    }
});

/* City button */

var includeTwfhr = true;

$(".city #city-list > li").click(selectCity);

function selectCity() {
    var cityID   = $(this).attr("data-city-id");
    var zoom     = $(this).attr("data-city-zoom");
    var cityName = $(this).children("a").html();
    var cityCrds = $(this).attr("data-city-coords");
    
    var coords = eval("(" + cityCrds + ")");    
    
    $("#city-button").attr("data-city-id", cityID);
    $("#city-button").attr("data-city-zoom", zoom);
    $("#city-button").attr("data-city-coords", cityCrds);
    $("#city-button > .f-button-caption > .f-button-text").html(cityName);
    
    iMap.showMap(coords.latitude, coords.longitude, zoom - 0);
    showMarkers(iMap);
    
    includeTwfhr = false;
    makeSearch();
}

/* Search button */

$(".search-button").click(makeSearch);

function makeSearch() {
    var srchres = $(".search-results");
    $(srchActive).hide("slow");
    $(srchres).show("slow");
    
    var city     = $(".city").children("div").children("button").attr("data-city-id");
    var brand    = $(srchActive).find(".brand").attr("data-id");
    var service  = $(srchActive).find(".wtype").attr("data-id");
    var district = $(srchActive).find(".company-district").attr("data-id");
    var name     = $(srchActive).find(".company-name").val();
    var address  = $(srchActive).find(".company-address").val();
    var ftwfhr   = $(srchActive).find(".f-twfhr");
    var twfhr    = ftwfhr[0].checked;
    
    if (!includeTwfhr) {
        twfhr = null;
        includeTwfhr = true;
    }
    
    $.ajax({
        url: "/index/srch-res/",
        method: "POST",
        data: {city: city, brand: brand, service: service, district: district, name: name, address: address, twfhr: twfhr},
        dataType: "json",
        success: function(r) {
            updateSrchRes(r.srchres);
        }
    });
}

/* Уточнить параметры поиска */

$(".srchres-header-title").click(backToSearch);

function backToSearch(e) {
    $(".search-results").hide("slow");
    $(srchActive).show("slow");
}

/* Search results */

function updateSrchRes(srchres) {
    var srlist = $(".srlist");
    var zoom = $("#city-button").attr("data-city-zoom");
        
    $(srlist).empty();
    showSrlistArrows(0);

    for (var i = 0; i < srchres.length; i++) {
        var sritemtmpl = $(".srlist-tmpl").children("li");
        $(sritemtmpl).clone().appendTo(srlist);
        var sritem = $(srlist).children("li").last();
        
        $(sritem).find(".srlist-ittl")
            .html(srchres[i].name)
            .attr("data-cid", srchres[i].id)
            .bind("click", openCard);
        
        $(sritem).find(".sr-address").html(getAddressStr2("", srchres[i].street, srchres[i].home, srchres[i].housing, srchres[i].building, true));
        $(sritem).find(".sr-shedule").html(getSheduleStr(srchres[i].shedule, srchres[i].twenty_four_hours));
        $(sritem).find(".sr-phone").html(srchres[i].phone);
        
        $(sritem).find(".sr-mapptr")
            .attr("data-latitude", srchres[i].latitude)
            .attr("data-longitude", srchres[i].longitude)
            .attr("data-zoom", zoom)
            .bind("click", posMap);
        
        if (srchres[i].twenty_four_hours === "0")
            $(sritem).find(".srlist-itwh").css("display", "none");
        
        if (srchres[i].special_offer_id === null)
            $(sritem).find(".srlist-ispo").css("display", "none");
    }
    
    $("#srchres-counter").html(srchres.length);
    showSrlistArrows(srchres.length > 4);
    
    iMap.clearMarkers();
    iMap.placeMarkers(srchres);
    iMap.markerClusterInit();
}

function posMap(e) {
    e.preventDefault();
    var lat  = $(e.currentTarget).attr("data-latitude" );
    var lng  = $(e.currentTarget).attr("data-longitude");
    var zoom = $(e.currentTarget).attr("data-zoom");
    iMap.clearMarkers();
    iMap.showMap(parseFloat(lat), parseFloat(lng), parseInt(zoom) + 5);
    iMap.showMarker(parseFloat(lat), parseFloat(lng));
}

function showSrlistArrows($show) {
    if ($show) {
        $("#srlist-arrow-d").show();
        $("#srlist-arrow-u").show();
    } else {
        $("#srlist-arrow-d").hide();
        $("#srlist-arrow-u").hide();
    }
}

// Показать маркеры

function showMarkers(map) {
    var city = $(".city").children("div").children("button").attr("data-city-id");
    
    $.ajax({
        url: "/index/get-coords/",
        method: "POST",
        data: {city: city },
        dataType: "json",
        success: function(r) {
            if (r.coords) {
                map.clearMarkers();
                map.placeMarkers(r.coords);
                map.markerClusterInit();
            }
        }
    });
}

