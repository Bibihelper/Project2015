/* Card */

$(".slider-href").click(openCard);

function openCard(e) {
    e.preventDefault();
    var cid = $(e.currentTarget).attr("data-cid");
    setLocation("/?cardid=" + cid);
    getCardData(cid);
}

function getCardData(cid) {
    $.ajax({
        url: "/company/get-card/?cid=" + cid,
        method: "POST",
        data: {cid: cid},
        dataType: "json",
        success: function(r) {
            updateData(r);
            $("#card").modal("show");
        }
    });    
}

var latitude1 = longitude1 = 0.0;

function updateData(r) {
    
    $("div.address > span.a-title").html(r.company.name);
    $("div.address > span.a-district").html(r.address.district);
    $("div.address > span.a-address").html(getAddressStr(r.address));
    $("div.address > span.a-shedule").html(getShedule(r.shedule, r.company.twenty_four_hours));
    $("div.address > div.a-phone > span.a-phone-number").html(r.company.phone || " - не указан");
    
    getBrand(r.brand);
    getService(r.category, r.service);
    getSpOffer(r.spoffer);
    getFile(r.file);

    latitude1  = parseFloat(r.address.latitude);
    longitude1 = parseFloat(r.address.longitude);
}

function setLocation(curLoc){
    try {
        history.pushState(null, null, curLoc);
        return;
    } catch(e) {}
    location.hash = '#' + curLoc;
}

$("#card").on("shown.bs.modal", function() {
    var m = new Map("address-map-id");
    m.showMap(latitude1, longitude1, 10);
    m.showMarker();
});

$("#card").on("hidden.bs.modal", function() {
    resetArrowsCounters();
    var m = new Map("address-map-id");
    m.showMap(63.31268278, 103.42773438);
    setLocation("/");
});

function getTwFourHour() {
    return "График работы: ежедневно <img src=\"/images/twenty-four-hour.png\" alt=\"\">";
}

function formatTime(time) {
    t = new Date('Thu, 01 Jan 1970 ' + time);
    
    var h = t.getHours  () + "";
    var m = t.getMinutes() + "";
    
    var i = (h.length === 1) ? "0" + h : h;
    var j = (m.length === 1) ? "0" + m : m;
    
    return i + ":" + j;
}

function getSheduleTable(shedule) {
    var DayOfWeek = ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'];
    var table = "";
    
    for (var i in shedule) {
        table += "&nbsp;&nbsp;&nbsp;" + DayOfWeek[shedule[i].day - 1] + ": " + 
            formatTime(shedule[i].begin) + "-" + formatTime(shedule[i].end) + "<br>";
    }
    
    return table;
}

function getShedule(shedule, twfh) {
    if (twfh == 1) {
        return getTwFourHour();
    }
    var sheduleTable = getSheduleTable(shedule);
    if (sheduleTable)
        return "График работы:<br>" + sheduleTable;
    else
        return "";
}

function showInfo(ul) {
    var info = $(ul).closest(".info");
    var len  = $(ul).children().length;
    
    if (len == 0 && info) {
        $(info).hide();
    } else {
        $(info).show();
    }
}    

function getBrand(brand) {
    $("ul.icon-list").empty();
    
    for (var i in brand) {
        var src = brand[i].icon_src + brand[i].icon_name;
        $("ul.icon-list").append("<li class=\"il-item\"><img src=\"" + src + "\" alt=\"\"></li>");
    }
    
    showInfo("ul.icon-list");
}

function getService(category, service) {
    var ulOpenTag  = "<ul class=\"srv-list\">";
    var ulCloseTag = "</ul>";

    $("ul.cat-list").empty();
    
    for (var i in category) {
        var srvItems = "";
        
        for (var j in service[i]) {
            srvItems += "<li class=\"sl-item\">" + service[i][j] + "</li>\n";
        }
        
        $("ul.cat-list").append("<li class=\"cl-item\"><span class=\"cl-item-text\">" +
            category[i].name + ":</span>" +
            ulOpenTag + srvItems + ulCloseTag + "</li>\n");
    }

    showInfo("ul.cat-list");
}

function getSpOffer(spoffer) {
    $("div.special-offer span.so-text"  ).html(spoffer.comment);
    $("div.special-offer span.so-period").html(getSpOfferPeriod(spoffer));
}

function getSpOfferPeriod(spoffer) {
    var t = spoffer.active_from.split(/[- :]/);
    var d = new Date(t[0], t[1]-1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
    var activeFrom = d;
    var t = spoffer.active_to.split(/[- :]/);
    var d = new Date(t[0], t[1]-1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
    var activeTo = d;
    var period = "С " + activeFrom.toLocaleDateString() + " по " + activeTo.toLocaleDateString();
    return period;
}

function getFile(file) {
    $("div.so-info > div.so-col-1 > img").attr("src", file.src + file.name);
}

function resetArrowsCounters() {
    $("ul.icon-list").attr("data-top", "0").css("top", "0px");
    $("ul.cat-list" ).attr("data-top", "0").css("top", "0px");
    
    disableArrowUp($("ul.icon-list").parent().prev());
    disableArrowUp($("ul.cat-list" ).parent().prev());
    
    enableArrowDown($("ul.icon-list").parent().next());
    enableArrowDown($("ul.cat-list" ).parent().next());
}

$("span.info-arrow-up").mousedown(infoArrowUp);
$("span.info-arrow-down").mousedown(infoArrowDown);
$("span.info-arrow-up-na").mousedown(infoArrowUp);
$("span.info-arrow-down-na").mousedown(infoArrowDown);

var step = 30, atime = 200;

function infoArrowUp(e) {
    var arrow  = $(e.currentTarget);
    var list   = $(arrow).next().children("ul");
    var top    = $(list).attr("data-top");
    
    top = parseInt(top) - step;
    top = top > 0 ? top : 0;

    $(list).animate({top : -top}, atime);
    $(list).attr("data-top", top);
    
    if (top === 0) {
        disableArrowUp(arrow);
    }
    
    enableArrowDown($(arrow).next().next());
}

function infoArrowDown(e) {
    var arrow  = $(e.currentTarget);
    var list   = $(arrow).prev().children("ul");
    var top    = $(list).attr("data-top");
    var height = list[0].clientHeight;
    
    top = parseInt(top) + step;
    top = top < height - 100 ? top : height - 100;
    
    $(list).animate({top : -top}, atime);
    $(list).attr("data-top", top);
    
    if (top === (height - 100)) {
        disableArrowDown(arrow);
    }
    
    enableArrowUp($(arrow).prev().prev());
}

function enableArrowUp(arrow) {
    if ($(arrow).hasClass("info-arrow-up-na")) {
        $(arrow).removeClass("info-arrow-up-na");
        $(arrow).addClass("info-arrow-up");
    }
}

function disableArrowUp(arrow) {
    if ($(arrow).hasClass("info-arrow-up")) {
        $(arrow).removeClass("info-arrow-up");
        $(arrow).addClass("info-arrow-up-na");
    }
}

function enableArrowDown(arrow) {
    if ($(arrow).hasClass("info-arrow-down-na")) {
        $(arrow).removeClass("info-arrow-down-na");
        $(arrow).addClass("info-arrow-down");
    }
}

function disableArrowDown(arrow) {
    if ($(arrow).hasClass("info-arrow-down")) {
        $(arrow).removeClass("info-arrow-down");
        $(arrow).addClass("info-arrow-down-na");
    }
}

