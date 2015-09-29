/* User register form */

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
    return true;
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

function rfCheckAll() {
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
    return true;
}

function lfCheckAll() {
    if (!checkEmail(document.getElementById("lf-email"))) {
        $("#lf-email").focus();
        return false;
    }
    if (!checkPassword(document.getElementById("lf-password"))) {
        $("#lf-password").focus();
        return false;
    }
    return true;
}

function rfSendForm() {
    var form = $("#register-form");
    
    $.ajax({
        url: "/user/register/",
        method: "POST",
        data: form.serialize(),
        dataType: "json",
        success: function(response) {
            showMessage(response.message);
        }
    });
}

function lfSendForm() {
    var form = $("#login-form");
    
    $.ajax({
        url: "/user/login/",
        method: "POST",
        data: form.serialize(),
        dataType: "json",
        success: function(response) {
            if (response.status === "OK") {
                window.location.href = "/private-room/?id=" + response.companyid;
            } else {
                showMessage(response.message);
            }
        }
    });
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
    if (!rfCheckAll()) {
        return false;
    }
    rfSendForm();
    $("#user-register-form").modal("hide");
});

$("#lf-email").blur(function() {
    checkEmail(this);
});

$("#lf-password").blur(function() {
    checkPassword(this);
});

$("#lf-submit").click(function() {
    if (!lfCheckAll()) {
        return false;
    }
    lfSendForm();
    $("#user-login-form").modal("hide");
});

$("#rf-login").click(function() {
    setTimeout(function() {
        $("#user-register-form").modal("hide");
    }, 200);
    setTimeout(function() {
        $("#user-login-form").modal("show");
    }, 700);
});

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

