/* Private room */

$(document).ready(function() {
  
});

// Календарь

Date.prototype.addDays = function(days)
{
    var dat = new Date(this.valueOf());
    dat.setDate(dat.getDate() + days);
    return dat;
}

$(function() {
    var val = $("#datepicker1").attr("data-date"), date;
    
    if (val == "") {
        date = (new Date());
    } else {
        date = (new Date(parseInt(val)));
    }
    
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
    var val = $("#datepicker2").attr("data-date"), date;
    
    if (val == "") {
        date = (new Date()).addDays(10);
    } else {
        date = (new Date(parseInt(val)));
    }
    
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
        $(cbx).addClass("info__cbx_active");
    } else {
        $(cbx).removeClass("info__cbx_active");
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

$("li.item-menu__i_first").click(function() {
    var cbx = $(this).children("div.info__chbx").children("span.info__cbx");
    var stt = $(cbx).attr("data-ch");
    stt = (stt == 0) ? 1 : 0;
    setCbxState(cbx, stt);

    var nxt = $(this).next();
    var len = $(nxt).length;
    
    while (len != 0) {
        var nxx = $(nxt).children("div.info__chbx").children("span.info__cbx");
        setCbxStateDB(nxx, stt);
        nxt = $(nxt).next();
        len = $(nxt).length;
    }

    return true;
});

$("li.item-menu__i").click(function() {
    var cbx = $(this).children("div.info__chbx").children("span.info__cbx");
    var stt = $(cbx).attr("data-ch");
    stt = (stt == 0) ? 1 : 0;
    setCbxStateDB(cbx, stt);
    return true;
});

function setCompanySB(cbx, state, url) {
    var cmid = $(cbx).attr("data-cid");
    var sbid = $(cbx).attr("data-sid");

    var request = $.ajax({
        url: url,
        method: "POST",
        data: { cmid: cmid, sbid: sbid, state: state },
        dataType: "xml"
    });

    request.success(function(xml) {
        var status = $(xml).find("status").text();
        
        if (status === "OK") {
            setCbxState(cbx, state);
        }
    });
}

// Информация о компании

$("#cinfo-save-btn").click(function() {
    var cid = $("#cinfo-comment").attr("data-cid");
    var txt = $("#cinfo-comment").val();
    
    var request = $.ajax({
        url: "/private-room/set-company-comment/",
        method: "POST",
        data: { cid: cid, txt: txt },
        dataType: "xml"
    });

    request.success(function(xml) {
        var status = $(xml).find("status").text();
        
        if (status === "OK") {
            $("#cinfo-save-btn").attr("disabled", "disabled");
        }
    });
});

$("#cinfo-comment").keyup(function() {
    $("#cinfo-save-btn").removeAttr("disabled");
});

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

// Личные настройки аккаунта

$("#send-site-news").click(function() {
    var ch = $(this).attr("data-ch");
    ch = (ch == 0) ? 1 : 0;
    $(this).attr("data-ch", ch);
    if (ch == 1)
        $(this).css("background-position", "-23px 0");
    else
        $(this).css("background-position", "0 0");
});

function showMessage(msg) {
    alert(msg);
}

$("#save-psw").click(function() {
    var pswOld = $("#psw-old").val();
    var pswNew = $("#psw-new").val();
    var pswCnf = $("#psw-confirm").val();
    var cid    = $("#options-pr").attr("data-cid");
    
    if (pswOld === "") {
        showMessage("Введите старый пароль");
        $("#psw-old").focus();
        return false;    
    }
    
    if (pswNew === "") {
        showMessage("Введите новый пароль");
        $("#psw-new").focus();
        return false;    
    }
    
    if (pswNew.length < 6) {
        showMessage("Минимальная длина пароля - 6 символов");
        $("#psw-new").focus();
        return false;    
    }
    
    if (pswNew !== pswCnf) {
        showMessage("Пароли не совпадают");
        $("#psw-confirm").focus();
        return false;    
    }
    
    var request = $.ajax({
        url: "/private-room/change-password/",
        method: "POST",
        data: { pswOld: pswOld, pswNew: pswNew, pswCnf: pswCnf, cid: cid },
        dataType: "xml"
    });

    request.success(function(xml) {
        var status = $(xml).find("status").text();
        
        if (status === "OK") {
            showMessage("Пароль изменен");
            $("psw-old").val("");
            $("psw-new").val("");
            $("psw-confirm").val("");
        }
        
        if (status === "ERROR") {
            var code  = $(xml).find("code") .text();
            var error = $(xml).find("error").text();
            
            showMessage("Не удалось изменить пароль: " + code + " - " + error);
        }
    });
    
    return true;    
});

$("#save-email").click(function() {
    var email = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    var emailNew = $("#new-email").val();
    var cid = $("#options-pr").attr("data-cid");
    
    if (!email.test(emailNew)) {
        showMessage("Неверный email");
        return false;
    }
    
    var request = $.ajax({
        url: "/private-room/change-email/",
        method: "POST",
        data: { email: emailNew, cid: cid },
        dataType: "xml"
    });

    request.success(function(xml) {
        var status = $(xml).find("status").text();
        
        if (status === "OK") {
            showMessage("E-mail изменен");
        }
        
        if (status === "ERROR") {
            var code  = $(xml).find("code") .text();
            var error = $(xml).find("error").text();

            showMessage("Не удалось изменить E-mail: " + code + " - " + error);
        }
    });
    
    return true;
});

// Logo

$(".logo").click(function() {
    window.location.href = $(this).attr("data-home");
});

// Загрузка картинки

var image;

$("#s-browse").click(function() {
    $("#s-br").click();
});

$("#s-br").change(function() {
    $("#s-filename").val($("#s-br").val());
    $("#s-load-image").removeClass("disabled");
    
    image = this.files;
});

$("#s-publish").click(function() {
    if ($(this).hasClass("disabled")) {
        return false;
    }
    
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
            dataType: "xml"
        });
        
        var sPublish = this;

        request.success(function(xml) {
            var status = $(xml).find("status").text();

            if (status === "OK") {
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
            dataType: "xml"
        });
        
        var sPublish = this;

        request.success(function(xml) {
            var status = $(xml).find("status").text();

            if (status === "OK") {
                $(".s-off-ctrls").show();
                $(".s-off-preview").css("float", "right");
                $(sPublish).text("Опубликовать").attr("data-btn-type", "1").addClass("disabled");
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
    if ($("#s-descr-edit").val().length > 6 && $("#s-image").attr("data-load") == "1") {
        $("#s-publish").removeClass("disabled")
    } else {
        $("#s-publish").addClass("disabled")      
    } 
}

$("#s-load-image").click(function() {
    if ($(this).hasClass("disabled")) {
      return false;
    }
    
    var data = new FormData();

    $.each(image, function(key, value) {
        data.append(key, value);
    });
    
    var cID = $("#c-id").html();
    
    var request = $.ajax({
        url: '/private-room/load-image/?id=' + cID,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'xml',
        processData: false,
        contentType: false,
    });

    request.success(function(xml) {
        var status   = $(xml).find("status"  ).text();
        var filename = $(xml).find("filename").text();
        
        if (status === "OK") {

            $("#s-image").attr("src", filename);
            $("#s-image").attr("data-load", "1");
            
            updateStatePublishBtn();
            
        }
    });
});

// Описание специального предложения

$("#s-descr-edit").keyup(function() {

  $("#s-descr").html($(this).val());
  
  updateStatePublishBtn();
  
});