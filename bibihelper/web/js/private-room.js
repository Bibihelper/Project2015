/* Private room */

$(document).ready(function() {
    showPosition();
    $('#optionsform-company_phone').mask('+7 (000) 000-00-00');
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
            if (r.latitude === 0 || r.longitude === 0 || r.latitude === null || r.langitude === null)
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

Date.prototype.setMyDate = function(dateText)
{
    var arrDate = dateText.split(".");
    var myDate = new Date();
    myDate.setDate(arrDate[0]);
    myDate.setMonth(arrDate[1] - 1);
    myDate.setFullYear(arrDate[2]);
    myDate.setHours(0);
    myDate.setMinutes(0);
    myDate.setSeconds(0);
    myDate.setMilliseconds(0);
    return myDate;
};

$(function() {
    var date = (new Date());
    
    $("#datepicker1").datepicker($.datepicker.regional["ru"]);
    $("#datepicker1").datepicker("setDate", date);
    $("#datepicker1").datepicker("option", "minDate", "0d");
    $("#datepicker1").datepicker("option", "maxDate", "1m");
    
    $('#datepicker1').datepicker('option', 'beforeShow', function() {
        if (!$("#c-arrow-1").hasClass("ca-exp")) {
            $("#c-arrow-1").removeClass("c-arrow_expand").addClass("c-arrow_collapse").addClass("ca-exp");
        }
        return true;
    });
    
    $('#datepicker1').datepicker('option', 'onClose', function(dateText, inst) {
        if ($("#c-arrow-1").hasClass("ca-exp")) {
            $("#c-arrow-1").removeClass("c-arrow_collapse").removeClass("ca-exp").addClass("c-arrow_expand");
        }
        if (dateText === "") {
            $("#datepicker1").datepicker("setDate", new Date());
        } else {
            var maxDate = $("#datepicker2").datepicker("getDate");
            var selDate = (new Date()).setMyDate(dateText);
            var diff = selDate - maxDate;
            if (diff > 0)
                $("#datepicker1").datepicker("setDate", maxDate);
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
    $("#datepicker2").datepicker("option", "minDate", "0d");
    $("#datepicker2").datepicker("option", "maxDate", "1m");
    
    $('#datepicker2').datepicker('option', 'beforeShow', function() {
        if (!$("#c-arrow-2").hasClass("ca-exp")) {
            $("#c-arrow-2").removeClass("c-arrow_expand").addClass("c-arrow_collapse").addClass("ca-exp");
        }
        return true;
    });
    
    $('#datepicker2').datepicker('option', 'onClose', function(dateText, inst) {
        if ($("#c-arrow-2").hasClass("ca-exp")) {
            $("#c-arrow-2").removeClass("c-arrow_collapse").removeClass("ca-exp").addClass("c-arrow_expand");
        }
        if (dateText === "") {
            $("#datepicker2").datepicker("setDate", new Date());
        } else {
            var minDate = $("#datepicker1").datepicker("getDate");
            var selDate = (new Date()).setMyDate(dateText);
            var diff = minDate - selDate;
            if (diff > 0)
                $("#datepicker2").datepicker("setDate", minDate);
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
        var image = $(".primg > img").attr("src");
        var comment = $("#s-descr-edit").val();
        var activeFrom = $("#datepicker1").datepicker("getDate");
        var activeTo = $("#datepicker2").datepicker("getDate");

        var request = $.ajax({
            url: "/private-room/set-special-offer/",
            method: "POST",
            data: { cid: cid, image: image, comment: comment, activeFrom: activeFrom.toLocaleString(), activeTo: activeTo.toLocaleString() },
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
                $(sPublish).text("Опубликовать").attr("data-btn-type", "1");
                document.getElementById("s-publish").disabled = true;
                $("#s-image").attr("src", "/images/s-img.png").attr("data-load", "0");
                $("#s-descr-edit").val("");
                $("#s-descr").html("");
                $("#datepicker1").datepicker("setDate", (new Date()));
                $("#datepicker2").datepicker("setDate", (new Date()).addDays(10));
            }
        });
    }
});

function updateStatePublishBtn() {
    if ($("#s-image").attr("data-load") === "1") {
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

$("#optionsform-shedule_every_day").change(function() {
    document.getElementById("optionsform-shedule_mon").checked = this.checked;
    document.getElementById("optionsform-shedule_tue").checked = this.checked;
    document.getElementById("optionsform-shedule_wed").checked = this.checked;
    document.getElementById("optionsform-shedule_thu").checked = this.checked;
    document.getElementById("optionsform-shedule_fri").checked = this.checked;
    document.getElementById("optionsform-shedule_sat").checked = this.checked;
    document.getElementById("optionsform-shedule_sun").checked = this.checked;
    
    if (this.checked) {
        $("#shedule_days").slideUp();
    } else {
        $("#shedule_days").slideDown();
    }
});

$("#optionsform-shedule_twfhr").change(function() {
    if (this.checked) {
        $("#shedule_clock").slideUp();
    } else {
        $("#shedule_clock").slideDown();
    }
});

$(".cntr-arrow-up").click(function() {
    var t = $(this).next();
    var i = $(t).siblings("div.f-block").children("input[type = hidden]");
    var v = parseInt($(i).val());

    if ($(t).hasClass("cntr-hours")) {
        v--;
        if (v < 0) {
            v = 23;
            $(t).children("img").css("top", -25 * 24 + "px");
        }
        $(t).children("img").animate({top: -25 * v});
        $(i).val(v);
    }
    
    if ($(t).hasClass("cntr-minutes")) {
        v = v - 15;
        if (v < 0) {
            v = 45;
            $(t).children("img").css("top", -25 * 4 + "px");
        }
        $(t).children("img").animate({top: -25 * Math.floor(v / 15)});
        $(i).val(v);
    }
});

$(".cntr-arrow-down").click(function() {
    var t = $(this).prev();
    var i = $(t).siblings("div.f-block").children("input[type = hidden]");
    var v = parseInt($(i).val());
    
    if ($(t).hasClass("cntr-hours")) {
        v++;
        if (v > 23) {
            v = 0;
            $(t).children("img").animate({top: -25 * 24 + "px"}, 400, function() {
                $(t).children("img").css("top", 0);
            });
        } else {
            $(t).children("img").animate({top: -25 * v});
        }
        $(i).val(v);
    }
    
    if ($(t).hasClass("cntr-minutes")) {
        v = v + 15;
        if (v > 45) {
            v = 0;
            $(t).children("img").animate({top: -25 * 4 + "px"}, 400, function() {
                $(t).children("img").css("top", 0);
            });
        } else {
            $(t).children("img").animate({top: -25 * Math.floor(v / 15)});
        }
        $(i).val(v);
    }
});

$("#opt-ch").click(function() {
    var b = $("#profile").children("div");
    $(b[0]).slideUp();
    $(b[1]).slideUp();
    $(b[2]).slideDown();
});

/* User options */

$("body").on("beforeSubmit", "form#change-password-form, form#change-email-form", proceedChangeForm);

function proceedChangeForm() {
     var form = $(this);
     if (form.find('.has-error').length) {
          return false;
     }
     $.ajax({
          url: form.attr("action"),
          method: "post",
          data: form.serialize(),
          success: function (r) {
                alert(r.message);
          }
     });
     return false;
};

/* Company info */

$("#ci-submit").click(function() {
    var form = $("#company-info-form");
    var sbtn = this;
    
    $.ajax({
        url: "/company/save-info/",
        method: "POST",
        data: form.serialize(),
        dataType: "json",
        success: function(r) {
            if (r.status === "OK") {
                $(sbtn).attr("disabled", "disabled");
            }
        }
    });
});

$("#ci-info").keyup(function() {
    $("#ci-submit").removeAttr("disabled");
});

























