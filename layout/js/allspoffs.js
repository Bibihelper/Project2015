/* All special offers */

$(document).ready(function() {
    proceedUrl();
});

var ROW_HEIGHT = 329;

$("#arrow-down").click(function() {
    var v = $(".allspoff-viewport");
    var i = $(v).attr("data-item");
    var l = $(v).children().length - 2;
    if (i === undefined)
        i = 0;
    i++;
    if (i < l) {
        $(v).animate({top: -i * ROW_HEIGHT + "px"}).attr("data-item", i);
    }
    if (i === (l - 1)) {
        if ($(this).hasClass("allspoff-arrow-down")) {
            $(this).removeClass("allspoff-arrow-down");
            $(this).addClass("allspoff-arrow-down-na");
        }
    }
    var a = $(".allspoff-arrow-up-na");
    if ($(a) !== null) {
        $(a).removeClass("allspoff-arrow-up-na");
        $(a).addClass("allspoff-arrow-up");
    }
});

$("#arrow-up").click(function() {
    var v = $(".allspoff-viewport");
    var i = $(v).attr("data-item");
    if (i === undefined)
        i = 0;
    i--;
    if (i >= 0) {
        $(v).animate({top: -i * ROW_HEIGHT + "px"}).attr("data-item", i);
    }
    if (i === 0) {
        if ($(this).hasClass("allspoff-arrow-up")) {
            $(this).removeClass("allspoff-arrow-up");
            $(this).addClass("allspoff-arrow-up-na");
        }
    }
    var a = $(".allspoff-arrow-down-na");
    if ($(a) !== null) {
        $(a).removeClass("allspoff-arrow-down-na");
        $(a).addClass("allspoff-arrow-down");
    }
});

