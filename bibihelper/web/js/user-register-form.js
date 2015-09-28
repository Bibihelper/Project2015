/* User register form */

function rfCheckEmail(ctrl) {
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

function rfCheckPassword(ctrl) {
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

function rfCheckPasswordOk(ctrl) {
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
    if (!rfCheckEmail(document.getElementById("rf-email"))) {
        $("#rf-email").focus();
        return false;
    }
    if (!rfCheckPassword(document.getElementById("rf-password"))) {
        $("#rf-password").focus();
        return false;
    }
    if (!rfCheckPasswordOk(document.getElementById("rf-password-ok"))) {
        $("#rf-password-ok").focus();
        return false;
    }
    return true;
}

function rfSendForm() {
    var form = $("#rf");
    
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

$("#rf-email").blur(function() {
    rfCheckEmail(this);
});

$("#rf-password").blur(function() {
    rfCheckPassword(this);
});

$("#rf-password-ok").keyup(function() {
    rfCheckPasswordOk(this);
});

$("#rf-submit").click(function() {
    if (!rfCheckAll()) {
        return false;
    }
    rfSendForm();
    $("#company-rf").modal("hide");
});





