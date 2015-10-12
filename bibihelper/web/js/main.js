/* Main */

// Переключение форм login - register

$("#lf-register").click(function() {
    setTimeout(function() {
        $("#user-login-form").modal("hide");
    }, 200);
    setTimeout(function() {
        $("#user-register-form").modal("show");
    }, 700);
});

$("#lf-restore-password").click(function() {
    setTimeout(function() {
        $("#user-login-form").modal("hide");
    }, 200);
    setTimeout(function() {
        $("#user-restorepsw-form").modal("show");
    }, 700);
});

$("#rf-login").click(function() {
    setTimeout(function() {
        $("#user-register-form").modal("hide");
    }, 200);
    setTimeout(function() {
        $("#user-login-form").modal("show");
    }, 700);
});

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

/* Back to search button */

$(".back-to-search-button").click(function() {
    var href = $("div.logo").parent("a").attr("href");
    window.location.href = href;
});

/* login form submit button */

$("#lf-submit").click(lfSubmit);

function lfSubmit(e) {
    var count = $(this).attr("data-count");
    if (count === undefined)
        count = 1;
    else
        count++;
    $(this).attr("data-count", count);
    if (count >= 5) {
        $(this).addClass("disabled");
        window.location.href = "/?f=1";
    }
}

/* proceed URL */

function proceedUrl() {
    var url = document.URL;
    
    if (url.indexOf("f=1") !== -1) {
        setTimeout(function() {
            $("#user-login-form").modal("show");
        }, 700);
    }
    
    var i = url.indexOf("?cardid=");
    
    if (i !== -1) {
        var cid = url.substr(i + 8, url.length);
        getCardData(cid);
    }
}

/* Address formating helpers */

function fmtCity(city) {
    city += "";
    return (city.indexOf("г.") === -1) ? "г. " + city : city;
}

function fmtStreet(street) {
    street += "";
    return (street.indexOf("ул.") === -1) ? "ул. " + street : street;
}

function fmtHome(home) {
    home += "";
    return (home.indexOf("д.") === -1) ? "д. " + home : home;
}

function fmtHousing(housing) {
    housing += "";
    return (housing.indexOf("к.") === -1) ? "к. " + housing : housing;
}

function fmtBuilding(building) {
    building += "";
    return (building.indexOf("стр.") === -1) ? "стр. " + building : building;
}


