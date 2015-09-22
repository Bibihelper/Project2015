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
    $("#datepicker1").datepicker($.datepicker.regional["ru"]);
    $("#datepicker1").datepicker("setDate", new Date())
    
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
    $("#datepicker2").datepicker($.datepicker.regional["ru"]);                
    $("#datepicker2").datepicker("setDate", (new Date()).addDays(10))
    
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
            setCompanyService(cbx, state);
            break;
        
        case "brand":
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

function setCompanyService(cbx, state) {
    var cid = $(cbx).attr("data-cid");
    var sid = $(cbx).attr("data-sid");

    var request = $.ajax({
        url: "/private-room/set-company-service/",
        method: "POST",
        data: { cid: cid, sid: sid, state: state },
        dataType: "xml"
    });

    request.success(function(xml) {
        var status = $(xml).find("status").text();
        
        if (status === "OK") {
            setCbxState(cbx, state);
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

function showMessage($msg) {

}

$("#save-psw").click(function() {
    $("#dialog").attr("title", "Изменение пароля");
    var pswOld = $("#psw-old").val();
    var pswNew = $("#psw-new").val();
    var pswOld = $("#psw-confirm").val();
    if (pswOld === "") {
        showMessage("Введите старый пароль");
    } else 
    if (pswNew === "") {
        showMessage("Введите новый пароль");
    } else 
    if (pswNew.length < 6) {
        showMessage("Минимальная длина пароля - 6 символов");
    } else
    if (pswNew === pswOld) {
        showMessage("Пароль изменен");
    } else {
        showMessage("Пароли не совпадают");
    }
    return false;    
});

$("#save-email").click(function() {
    $("#dialog").attr("title", "Изменение E-mail");
    var email = /^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/;
    var emailNew = $("#new-email").val();
    if (email.test(emailNew)) {
        showMessage("Неверный email");
    } else {
        showMessage("E-mail изменен");
    }
    return false;
});

// Logo

$(".logo").click(function() {
    window.location.href = "http://bibihelper.com/";
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

    $(".s-off-ctrls").hide();
    $(".s-off-preview").css("float", "none");
    $(this).text("Удалить предложение").attr("data-btn-type", "2");
});

function updateStatePublishBtn() {
    if ($("#s-descr-edit").val().length > 6 && $("#s-br").val().length > 4) {
        $("#s-publish").removeClass("disabled")
    } else {
        $("#s-publish").addClass("disabled")      
    };  
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
        url: '/private-room/load-image-tmp/?id=' + cID,
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
            
            updateStatePublishBtn();
            
        }
    });
});

// Описание специального предложения

$("#s-descr-edit").keyup(function() {

  $("#s-descr").html($(this).val());
  
  updateStatePublishBtn();
  
});