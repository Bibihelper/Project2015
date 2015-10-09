/* Main */

// Переключение форм login - register

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

/* City button */

$(".city #city-list > li").click(function() {
    var cityID   = $(this).attr("data-city-id");
    var cityName = $(this).children("a").html();
    
    $("#city-button").attr("data-city-id", cityID);
    $("#city-button > .c-button-caption > .c-button-text").html(cityName);
    
    var coords = eval("(" + $(this).attr("data-city-coords") + ")");    
    var m = new Map("map");
    m.showMap(coords.latitude, coords.longitude, 10);
});

/* Back to search button */

$(".back-to-search-button").click(function() {
    var href = $("div.logo").parent("a").attr("href");
    window.location.href = href;
});


