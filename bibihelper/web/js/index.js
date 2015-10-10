/* Index */

$(document).ready(function() {
    var m = new Map("map");
    m.showMap(63.31268278, 103.42773438);
    initSlider();
    
    var sl = $(".search-list");
    var he = $(sl).height();
    var lh = 28;
    
    $(sl).each(function (i, item) {
        var cc = $(item).children("li").length;
        var hh = cc * lh;
        if (hh < he) {
            $(item).height(hh);
        }
    });
    
    var url = document.URL;
    
    if (url.indexOf("login") !== -1) {
        setTimeout(function() {
            $("#user-login-form").modal("show");
        }, 700);
    }        
});

// Переключение между формами простого и расширенного поиска

$("#search-ext-button").click(function() {
    $(".search-simple").hide("slow");
    $(".search-ext").show("slow");
});

$("#search-simple-button").click(function() {
    $(".search-ext").hide("slow");
    $(".search-simple").show("slow");
});

// Синхронизация чекбоксов на формах простого и расширенного поиска

$("#twfhr-checkbox-1").click(function() {
    document.getElementById("twfhr-checkbox-2").checked = this.checked;
});

$("#twfhr-checkbox-2").click(function() {
    document.getElementById("twfhr-checkbox-1").checked = this.checked;
});

// Кнопки выбора на формах

$(".search-list > li").click(function() {
    var dataID   = $(this).attr("data-id");
    var dataName = $(this).children("a").html();
    
    var button = $(this).parent("ul").parent("div").children("button");
    var text   = $(button).children("span.f-button-caption").children("span.f-button-text");
    var li     = $(this).siblings("li[data-id = \"" + $(button).attr("data-id") +"\"]");
    
    if (!$(this).hasClass("search-item-group")) {
        $(li)  .children("a").css("background-color", "#e8e6e6");
        $(this).children("a").css("background-color", "#d5eded");
    }
    
    if ($(button).hasClass("brand")) {
        button = $(".brand");
        $(button).each(function(i, item) {
            text   = $(item).children("span.f-button-caption").children("span.f-button-text");
            $(item).attr("data-id", dataID);
            $(text).html(dataName);
        });
        return true;
    }
    
    if ($(button).hasClass("wtype")) {
        button = $(".wtype");
        $(button).each(function(i, item) {
            text   = $(item).children("span.f-button-caption").children("span.f-button-text");
            $(item).attr("data-id", dataID);
            $(text).html(dataName);
        });
        return true;
    }
    
    $(button).attr("data-id", dataID);
    $(text).html(dataName);
});

/* All special offers button */

$(".special-offers-button").click(function() {
    window.location.href = "/special-offers/";
});




