/* Register form */

function checkEmail(ctrl) {
    var regexp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

    var hint = $(ctrl).next("div.f-hint");
    $(hint).children("span.f-text").html("Неверный email");
    
    var test = regexp.test($(ctrl).val());
    
    if (test) {
        $(hint).hide();
        $(ctrl).removeClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "inline-block");
        return true;
    } else {
        $(hint)
            .css("left", "398px")
            .css("top", ctrl.offsetTop + ctrl.offsetHeight + 1);
        $(hint).show();
        $(ctrl).addClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "none");
        return false;
    }
}

function checkPassword(ctrl) {
    var hint = $(ctrl).next("div.f-hint");
    $(hint).children("span.f-text").html("Минимальная длина пароля - 6 символов");

    var test = $(ctrl).val().length >= 6;
    
    if (test) {
        $(hint).hide();
        $(ctrl).removeClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "inline-block");
        return true;
    } else {
        $(hint)
            .css("left", "250px")
            .css("top", ctrl.offsetTop + ctrl.offsetHeight + 1);
        $(hint).show();
        $(ctrl).addClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "none");
        return false;
    }
}

function checkPasswordOk(ctrl) {
    var hint = $(ctrl).next("div.f-hint");
    $(hint).children("span.f-text").html("Пароли не совпадают");

    var test = $(ctrl).val() === $("#rf-password").val();
    
    if (test) {
        $(hint).hide();
        $(ctrl).removeClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "inline-block");
        return true;
    } else {
        $(hint)
            .css("left", "362px")
            .css("top", ctrl.offsetTop + ctrl.offsetHeight + 1);
        $(hint).show();
        $(ctrl).addClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "none");
        return false;
    }
}

$("#rf-email").blur(function() {
    checkEmail(this);
});

$("#rf-password").blur(function() {
    checkPassword(this);
});

$("#rf-password-ok").keyup(function() {
    checkPasswordOk(this);
});

$("#rf-submit").click(function() {

    if (!checkEmail(document.getElementById("rf-email"))) {
        $("#rf-email").focus();
        return false;
    }

    if (!checkPassword(document.getElementById("rf-password"))) {
        $("#rf-password").focus();
        return false;
    }
    
    if (!checkPasswordOk(document.getElementById("rf-password-ok"))) {
        $("#rf-password-ok").focus();
        return false;
    }
    
    var email      = $("#rf-email"      ).val();
    var password   = $("#rf-password"   ).val();
    var passwordOk = $("#rf-password-ok").val();
    
    var request = $.ajax({
        url: "/index/register/",
        method: "POST",
        data: { email: email, password: password, passwordOk: passwordOk },
        dataType: "xml"
    });

    $("#company-rf").modal("hide");
    
    request.success(function(xml) {
        var status = $(xml).find("status").text();

        if (status === "OK") {
            showMessage("Вам на почту высланно письмо для подтверждения регистрации.");
        }
        
        if (status === "ERROR") {
            var error = $(xml).find("error").text();
            showMessage(error);
        }
    });
});





