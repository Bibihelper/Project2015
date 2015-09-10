/* Private room */

$(function() {
    $("#datepicker1").datepicker($.datepicker.regional["ru"]);
    
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

$("#s-browse").click(function() {
    $("#s-br").click();
});

$("#s-br").change(function() {
    $("#s-filename").val($("#s-br").val());
});

$("#s-publish").click(function() {
    $(".s-off-ctrls").hide();
    $(".s-off-preview").css("float", "none");
    $(this).text("Удалить предложение").attr("data-btn-type", "2");
})

function updCbxState(cbx, state) {
    $(cbx).attr("data-ch", state);

    if (state == 1) {
        $(cbx).addClass("info__cbx_active");
    } else {
        $(cbx).removeClass("info__cbx_active");
    }
}

function updCbxStateNextElem(elm, stt) {
    var nxt = $(elm).next();
    var len = $(nxt).length;
    if (len != 0) {
        var nxx = $(nxt).children("div.info__chbx").children("span.info__cbx");
        updCbxState(nxx, stt);
        updCbxStateNextElem(nxt, stt);
    }
}

$("li.item-menu__i").click(function() {
    var cbx = $(this).children("div.info__chbx").children("span.info__cbx");
    var stt = $(cbx).attr("data-ch");
    stt = (stt == 0) ? 1 : 0;
    updCbxState(cbx, stt);
    if ($(this).hasClass("item-menu__i_first"))
        updCbxStateNextElem($(this), stt);
    return true;
});

$("a.arrow-item").click(function() {
    var exp = $(this).attr("data-exp");
    var sbm = $(this).parent("span").next("ul");
    exp = (exp == 0) ? 1 : 0;
    $(this).attr("data-exp", exp);
    if (exp == 1) {
        $(this).children("img").attr("src", "images/arrow-item-left.png");
        $(sbm).addClass("item-menu_active");
    } else {
        $(this).children("img").attr("src", "images/arrow-item-right.png");
        $(sbm).removeClass("item-menu_active");
    }
});

$("#send-site-news").click(function() {
    var ch = $(this).attr("data-ch");
    ch = (ch == 0) ? 1 : 0;
    $(this).attr("data-ch", ch);
    if (ch == 1)
        $(this).css("background-position", "-23px 0");
    else
        $(this).css("background-position", "0 0");
});

var obj = {
    resizable: false,
    height: 150,
    modal: true,
    buttons: {
        OK: function() {
            $(this).dialog("close");
        }
    }
};
    
$("#save-psw").click(function() {
    $("#dialog").attr("title", "Изменение пароля");
    var pswNew = $("#psw-new").val();
    var pswOld = $("#psw-confirm").val();
    if (pswNew == "") {
        $("#dialog > p").text("Пароль не может быть пустым");
        $("#dialog").dialog(obj);
        return false;
    } else 
    if (pswNew.length < 6) {
        $("#dialog > p").text("Минимальная длина пароля - 6 символов");
        $("#dialog").dialog(obj);
    } else
    if (pswNew == pswOld) {
        $("#dialog > p").text("Пароль изменен");
        $("#dialog").dialog(obj);
    } else {
        $("#dialog > p").text("Пароли не совпадают");
        $("#dialog").dialog(obj);
    }
    return false;
});

$("#save-email").click(function() {
    $("#dialog").attr("title", "Изменение E-mail");
    var email = /^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/;
    var emailNew = $("#new-email").val();
    if (email.test(emailNew)) {
        $("#dialog > p").text("E-mail изменен");
        $("#dialog").dialog(obj);
    } else {
        $("#dialog > p").text("Введен некоректный email");
        $("#dialog").dialog(obj);
    }
});








