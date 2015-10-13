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
    $("#city-button > .f-button-caption > .f-button-text").html(cityName);
    
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

function getAddressStr(address) {
    var addr = [];
    
    if ( address.city     ) addr.push( fmtCity     ( address.city     ) );
    if ( address.street   ) addr.push( fmtStreet   ( address.street   ) );
    if ( address.home     ) addr.push( fmtHome     ( address.home     ) );
    if ( address.housing  ) addr.push( fmtHousing  ( address.housing  ) );
    if ( address.building ) addr.push( fmtBuilding ( address.building ) );
    
    return addr.join(", ");
}

function getAddressStr2(city, street, home, housing, building, cut) {
    if (street === "" || street === null)
        return "";
    
    var addr = [];
    
    if ( city     ) addr.push( fmtCity     ( city     ) );
    if ( street   ) addr.push( fmtStreet   ( street   ) );
    if ( home     ) addr.push( fmtHome     ( home     ) );
    if ( housing  ) addr.push( fmtHousing  ( housing  ) );
    if ( building ) addr.push( fmtBuilding ( building ) );
    
    if (cut) {
        var addr2 = addr.join(", ");
        var addr3 = (addr2.length > 24) ? addr2.substr(0, 19) + " ..." : addr2;
        return addr3;
    }
    
    return addr.join(", ");
}

/* Shedule helpers */

function formatTime(time) {
    t = new Date('Thu, 01 Jan 1970 ' + time);
    
    var h = t.getHours  () + "";
    var m = t.getMinutes() + "";
    
    var i = (h.length === 1) ? "0" + h : h;
    var j = (m.length === 1) ? "0" + m : m;
    
    return i + ":" + j;
}

function getSheduleStr(shedule, twfhr) {
    if (!shedule)
        return "";
    
    var DayOfWeek = ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'];
    var days = [];
    var time = null;
    
    for (var i = 0; i < shedule.length; i++) {
        var dayNumber = shedule[i]["day"];
        days.push(DayOfWeek[dayNumber]);
        time = formatTime(shedule[i]["begin"]) + "-" + formatTime(shedule[i]["end"]);
    }
    
    if (!time || time === "NaN:NaN-Nan:NaN")
        return "";
    
    var sheduleStr = "";
    
    if (days.length === 7) {
        sheduleStr = (twfhr === "1") ? "(ежедневно)" : time + " (ежедневно)";
    } else {
        sheduleStr = (twfhr === "1") ? days.join(",") : days.join(",") + ": " + time;
    }
    
    return sheduleStr;
}


