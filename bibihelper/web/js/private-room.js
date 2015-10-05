/* Private room */

$(document).ready(function() {
    showPosition();
});

// Координаты

function showPosition() {
    var m = null;

    $.ajax({
        url: "/private-room/get-coords/",
        method: "POST",
        data: { },
        dataType: "json",
        success: function(r) {
            m = new Map("private-room-map-id");
            if (r.latitude === 0 || r.longitude === 0)
                m.showMap(63.31268278, 103.42773438);
            else
                m.showMap(r.latitude, r.longitude, 10);
            m.showMoveableMarker();
        }
    });
}

// Календарь

Date.prototype.addDays = function(days)
{
    var dat = new Date(this.valueOf());
    dat.setDate(dat.getDate() + days);
    return dat;
};

$(function() {
    var date = (new Date());
    
    $("#datepicker1").datepicker($.datepicker.regional["ru"]);
    $("#datepicker1").datepicker("setDate", date);
    
    $('#datepicker1').datepicker('option', 'beforeShow', function() {
        if (!$("#c-arrow-1").hasClass("ca-exp")) {
            $("#c-arrow-1").removeClass("c-arrow_expand").addClass("c-arrow_collapse").addClass("ca-exp");
        }
        return true;
    });
    
    $('#datepicker1').datepicker('option', 'onClose', function() {
        if ($("#c-arrow-1").hasClass("ca-exp")) {
            $("#c-arrow-1").removeClass("c-arrow_collapse").removeClass("ca-exp").addClass("c-arrow_expand");
        }
        return true;
    });
});

$("#c-arrow-1").click(function(e) {
    if ($(this).hasClass("ca-exp")) {
        $('#datepicker1').datepicker("hide");
    } else {
        $('#datepicker1').datepicker("show");
    }
    return true;
});

$(function() {
    var date = (new Date()).addDays(10);
    
    $("#datepicker2").datepicker($.datepicker.regional["ru"]);                
    $("#datepicker2").datepicker("setDate", date);
    
    $('#datepicker2').datepicker('option', 'beforeShow', function() {
        if (!$("#c-arrow-2").hasClass("ca-exp")) {
            $("#c-arrow-2").removeClass("c-arrow_expand").addClass("c-arrow_collapse").addClass("ca-exp");
        }
        return true;
    });
    
    $('#datepicker2').datepicker('option', 'onClose', function() {
        if ($("#c-arrow-2").hasClass("ca-exp")) {
            $("#c-arrow-2").removeClass("c-arrow_collapse").removeClass("ca-exp").addClass("c-arrow_expand");
        }
        return true;
    });
});

$("#c-arrow-2").click(function(e) {
    if ($(this).hasClass("ca-exp")) {
        $('#datepicker2').datepicker("hide");
    } else {
        $('#datepicker2').datepicker("show");
    }
    return true;
});

// Чекбоксы

function setCbxState(cbx, state) {
    $(cbx).attr("data-ch", state);

    if (state == 1) {
        $(cbx).addClass("info-cbx-active");
    } else {
        $(cbx).removeClass("info-cbx-active");
    }    
}

function setCbxStateDB(cbx, state) {
    var type = $(cbx).attr("data-type");

    switch (type) {
        case "service":
            setCompanySB(cbx, state, "/private-room/set-company-service/");
            break;
        
        case "brand":
            setCompanySB(cbx, state, "/private-room/set-company-brand/");
            break;
    }
}

$("li.item-menu-ifirst").click(function() {
    var cbx = $(this).children("div.info-chbx").children("span.info-cbx");
    var stt = $(cbx).attr("data-ch");
    stt = (stt == 0) ? 1 : 0;
    setCbxState(cbx, stt);

    var nxt = $(this).next();
    var len = $(nxt).length;
    
    while (len != 0) {
        var nxx = $(nxt).children("div.info-chbx").children("span.info-cbx");
        setCbxStateDB(nxx, stt);
        nxt = $(nxt).next();
        len = $(nxt).length;
    }

    return true;
});

$("li.item-menu-i").click(function() {
    var cbx = $(this).children("div.info-chbx").children("span.info-cbx");
    var stt = $(cbx).attr("data-ch");
    stt = (stt == 0) ? 1 : 0;
    setCbxStateDB(cbx, stt);
    return true;
});

function setCompanySB(cbx, state, url) {
    var cmid = $(cbx).attr("data-cid");
    var sbid = $(cbx).attr("data-sid");

    setCbxState(cbx, state);

    var request = $.ajax({
        url: url,
        method: "POST",
        data: { cmid: cmid, sbid: sbid, state: state },
        dataType: "json"
    });

    request.success(function(r) {
        if (r.status === "ERROR") {
            setCbxState(cbx, !state);
        }
    });
}

// Стрелки

$("a.arrow-item").click(function() {
    var exp = $(this).attr("data-exp");
    var sbm = $(this).parent("span").next("ul");
    exp = (exp == 0) ? 1 : 0;
    $(this).attr("data-exp", exp);
    if (exp == 1) {
        $(this).children("img").attr("src", "/images/arrow-item-left.png");
        $(sbm).addClass("item-menu_active");
    } else {
        $(this).children("img").attr("src", "/images/arrow-item-right.png");
        $(sbm).removeClass("item-menu_active");
    }
});

// Загрузка картинки

var image;

$("#s-browse").click(function() {
    $("#s-br").click();
});

$("#s-br").change(function() {
    $("#s-filename").val($("#s-br").val());
    document.getElementById("s-load-image").disabled = false;
    
    image = this.files;
});

$("#s-load-image").click(function() {
    var data = new FormData();

    $.each(image, function(key, value) {
        data.append(key, value);
    });
    
    var cID = $("#cid").html();
    
    var request = $.ajax({
        url: "/private-room/load-image/?id=" + cID,
        type: 'POST',
        data: data,
        cache: false,
        dataType: "json",
        processData: false,
        contentType: false,
    });

    request.success(function(r) {
        if (r.status === "OK") {
            $("#s-image").attr("src", r.filename);
            $("#s-image").attr("data-load", "1");
            updateStatePublishBtn();
        }
    });
});

$("#s-publish").click(function() {
    if ($(this).attr("data-btn-type") == "1") {
        var cid = $("#sp-off").attr("data-cid");
        var imgage = $(".primg > img").attr("src");
        var comment = $("#s-descr-edit").val();
        var activeFrom = $("#datepicker1").datepicker("getDate");
        var activeTo = $("#datepicker2").datepicker("getDate");

        var request = $.ajax({
            url: "/private-room/set-special-offer/",
            method: "POST",
            data: { cid: cid, image: imgage, comment: comment, activeFrom: activeFrom.toLocaleString(), activeTo: activeTo.toLocaleString() },
            dataType: "json"
        });
        
        var sPublish = this;

        request.success(function(r) {
            if (r.status === "OK") {
                $(".s-off-ctrls").hide();
                $(".s-off-preview").css("float", "none");
                $(sPublish).text("Удалить предложение").attr("data-btn-type", "2");
            }
        });
    }

    if ($(this).attr("data-btn-type") == "2") {
        var cid = $("#sp-off").attr("data-cid");

        var request = $.ajax({
            url: "/private-room/remove-special-offer/",
            method: "POST",
            data: { cid: cid },
            dataType: "json"
        });
        
        var sPublish = this;

        request.success(function(r) {
            if (r.status === "OK") {
                $(".s-off-ctrls").show();
                $(".s-off-preview").css("float", "right");
                $(sPublish).text("Опубликовать").attr("data-btn-type", "1").attr("disabled", "");
                $("#s-image").attr("src", "/images/s-img.png");
                $("#s-descr-edit").val("");
                $("#s-descr").html("");
                $("#datepicker1").datepicker("setDate", (new Date()));
                $("#datepicker2").datepicker("setDate", (new Date()).addDays(10));
            }
        });
    }
});

function updateStatePublishBtn() {
    if ($("#s-descr-edit").val().length > 0 && $("#s-image").attr("data-load") == "1") {
        document.getElementById("s-publish").disabled = false;
    } else {
        $("#s-publish").attr("disabled", "disabled");
    } 
}

// Описание специального предложения

$("#s-descr-edit").keyup(function() {

  $("#s-descr").html($(this).val());
  
  updateStatePublishBtn();
  
});

// Форма данных о компании

$(".frm-block > input[type='text']").keyup(function() {
    var regexp = /^[ a-zA-Zа-яА-Я0-9-_\.]*$/;
    $("#frm-hint-1 > span.hint-text").html("Допустим ввод символов руссокго и латинского алфавитов и знаков: . - ");
    if (this.id === "company_phone") {
        regexp = /^[ 0-9-\(\)\+]*$/;
        $("#frm-hint-1 > span.hint-text").html("Допустим ввод цифр и знаков: - ( ) + ");
    }
    var test = regexp.test($(this).val());
    
    if (!test) {
        $("#frm-hint-1")
            .css("left", 0)
            .css("top", this.offsetTop + this.offsetHeight + 1);
        $("#frm-hint-1").show();
        $(this).addClass("type-error");
    } else {
        $("#frm-hint-1").hide();
        $(this).removeClass("type-error");
    }
});

function uncheck(cbx) {
    $(cbx).removeClass("info-cbx-active");
    $(cbx).attr("data-ch", 0);
    $("#" + cbx.id + "_2").val(0);
}

function check(cbx) {
    $(cbx).addClass("info-cbx-active");
    $(cbx).attr("data-ch", 1);
    $("#" + cbx.id + "_2").val(1);
}

$(".frm-block .info-cbx-inline").click(function() {
    var state = $(this).attr("data-ch");
    switch (state) {
        case "0": check(this); break;
        case "1": uncheck(this); break;
    }
    switch (this.id) {
        case "shedule_every_day": setEveryDay(this); break;
        case "shedule_twfh"     : setTwfh(this);     break;
    }
});

function setEveryDay(cbx) {    
    var mon = document.getElementById("shedule_mon");
    var tue = document.getElementById("shedule_tue");
    var wed = document.getElementById("shedule_wed");
    var thu = document.getElementById("shedule_thu");
    var fri = document.getElementById("shedule_fri");
    var sat = document.getElementById("shedule_sat");
    var sun = document.getElementById("shedule_sun");
    var state = $(cbx).attr("data-ch");
    if (state === "1") {
        check(mon);
        check(tue);
        check(wed);
        check(thu);
        check(fri);
        check(sat);
        check(sun);
    } else {
        uncheck(mon);
        uncheck(tue);
        uncheck(wed);
        uncheck(thu);
        uncheck(fri);
        uncheck(sat);
        uncheck(sun);
    }

    var state = $(cbx).attr("data-ch");
    switch (state) {
        case "0": 
            $("#shedule_days").slideDown();
            break;
        case "1": 
            $("#shedule_days").slideUp();
            break;
    }
}

function setTwfh(cbx) {
    var state = $(cbx).attr("data-ch");
    switch (state) {
        case "0": 
            $("#shedule_clock").slideDown();
            break;
        case "1": 
            $("#shedule_clock").slideUp();
            break;
    }
}

$(".cntr-arrow-up").click(function() {
    var t = $(this).next();
    var v = parseInt($(t).attr("data-time"));

    if ($(t).hasClass("cntr-hours")) {
        if (v > 0) {
            v--;
            $(t).children("img").animate({top: -25 * v});
            $(t).attr("data-time", v);
            $("#" + $(t).attr("id") + "_2").val(v);
        }
    }
    
    if ($(t).hasClass("cntr-minutes")) {
        if (v > 0) {
            v = v - 15;
            $(t).children("img").animate({top: -25 * Math.floor(v / 15)});
            $(t).attr("data-time", v);
            $("#" + $(t).attr("id") + "_2").val(v);
        }
    }
});

$(".cntr-arrow-down").click(function() {
    var t = $(this).prev();
    var v = parseInt($(t).attr("data-time"));
    
    if ($(t).hasClass("cntr-hours")) {
        if (v < 23) {
            v++;
            $(t).children("img").animate({top: -25 * v});
            $(t).attr("data-time", v);
            $("#" + $(t).attr("id") + "_2").val(v);
        }
    }
    
    if ($(t).hasClass("cntr-minutes")) {
        if (v < 45) {
            v = v + 15;
            $(t).children("img").animate({top: -25 * Math.floor(v / 15)});
            $(t).attr("data-time", v);
            $("#" + $(t).attr("id") + "_2").val(v);
        }
    }
});

$("#opt-ch").click(function() {
    var b = $("#profile").children("div");
    $(b[0]).slideUp();
    $(b[1]).slideUp();
    $(b[2]).slideDown();
});






















