/* User register and login forms */

function checkEmail(ctrl, left) {
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
            .css("left", left)
            .css("top", ctrl.offsetTop + ctrl.offsetHeight + 1);
        $(hint).show();
        $(ctrl).addClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "none");
        return false;
    }
    return true;
}

function checkPassword(ctrl, left) {
    var hint = $(ctrl).next("div.f-hint");
    var length = $(ctrl).val().length;
    var test = true;

    if (length < 6) {
        $(hint).children("span.f-text").html("Минимальная длина пароля - 6 символов");
        test = false;
    } else if (length > 32) {
        $(hint).children("span.f-text").html("Максимальная длина пароля - 32 символа");
        test = false;
    }
    
    if (test) {
        $(hint).hide();
        $(ctrl).removeClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "inline-block");
        return true;
    } else {
        $(hint)
            .css("left", left)
            .css("top", ctrl.offsetTop + ctrl.offsetHeight + 1);
        $(hint).show();
        $(ctrl).addClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "none");
        return false;
    }
}

function checkPasswordOk(ctrl, left) {
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
            .css("left", left)
            .css("top", ctrl.offsetTop + ctrl.offsetHeight + 1);
        $(hint).show();
        $(ctrl).addClass("type-error");
        $(ctrl).prev("span.f-icon-ok").css("display", "none");
        return false;
    }
}

function rfCheckAll() {
    if (!checkEmail(document.getElementById("rf-email"), "398px")) {
        $("#rf-email").focus();
        return false;
    }
    if (!checkPassword(document.getElementById("rf-password"), "250px")) {
        $("#rf-password").focus();
        return false;
    }
    if (!checkPasswordOk(document.getElementById("rf-password-ok"), "362px")) {
        $("#rf-password-ok").focus();
        return false;
    }
    return true;
}

function lfCheckAll() {
    if (!checkEmail(document.getElementById("lf-email"), "398px")) {
        $("#lf-email").focus();
        return false;
    }
    if (!checkPassword(document.getElementById("lf-password"), "235px")) {
        $("#lf-password").focus();
        return false;
    }
    return true;
}

// register form - send data

function rfSendForm() {
    var form = $("#register-form");
    
    $.ajax({
        url: "/user/register/",
        method: "POST",
        data: form.serialize(),
        dataType: "json",
        success: function(response) {
            alert(response.message);
        }
    });
}

// login form - send data
//
//function sendLoginForm() {
//    var form = $("#login-form");
//    
//    $.ajax({
//        url: "/user/login/",
//        method: "POST",
//        data: form.serialize(),
//        dataType: "json",
//        success: function(response) {
//            if (response.status === "OK") {
//                window.location.href = "/private-room/?id=" + response.companyid;
//            } else {
//                alert(response.message);
//            }
//        }
//    });
//}

// События - форма регистрации

//$("#rf-email").blur(function() {
//    checkEmail(this, "398px");
//});
//
//$("#rf-password").blur(function() {
//    checkPassword(this, "250px");
//});
//
//$("#rf-password-ok").keyup(function() {
//    checkPasswordOk(this, "362px");
//});
//
//$("#rf-submit").click(function() {
//    if (!rfCheckAll()) {
//        return false;
//    }
//    rfSendForm();
//    $("#user-register-form").modal("hide");
//});
//
// События - форма входа

//$("#lf-email").blur(function() {
//    checkEmail(this,"398px");
//});
//
//$("#lf-password").blur(function() {
//    checkPassword(this, "235px");
//});
//
//$("#lf-submit").click(function() {
//    if (!lfCheckAll()) {
//        return false;
//    }
//    sendLoginForm();
//    $("#user-login-form").modal("hide");
//});

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







