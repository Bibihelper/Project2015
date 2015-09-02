﻿window.onload = init;

function init()
{
    $(".pre-btn-psw").tooltip();
    
    if (navigator.geolocation)
        navigator.geolocation.getCurrentPosition(displayLocation, displayError);
    else 
        alert("Определение местоположения не поддерживается.");

    VK.init({apiId: 5050952, onlyWidgets: true});
    VK.Widgets.Like("vk_like", {type: "mini", height: 24});
}

// logo

$(".logo").click(function() {
    window.location.href = "#";
})

// Переключение между формами простого и расширенного поиска

$("#ext-search-btn").click(function() {
    $(".search_simple").hide("slow");
    $(".search_ext").show("slow");
})

$("#simple-search-btn").click(function() {
    $(".search_ext").hide("slow");
    $(".search_simple").show("slow");
})

// Чекбоксы на формах простого и расширенного поиска

$("#search_simple__tw-check").click(function() {
    if ($("#search_simple__tw-cbx")[0].checked) {
        $("#search_simple__tw-check").css("background-position", "0 0");
        $("#search_simple__tw-cbx")[0].checked = false;        
        $("#search_ext__tw-check").css("background-position", "0 0");
        $("#search_ext__tw-cbx")[0].checked = false;        
    } else {
        $("#search_simple__tw-check").css("background-position", "-25px 0");    
        $("#search_simple__tw-cbx")[0].checked = true;        
        $("#search_ext__tw-check").css("background-position", "-25px 0");    
        $("#search_ext__tw-cbx")[0].checked = true;        
    }
})

$("#search_ext__tw-check").click(function() {
    if ($("#search_ext__tw-cbx")[0].checked) {
        $("#search_ext__tw-check").css("background-position", "0 0");
        $("#search_ext__tw-cbx")[0].checked = false;        
        $("#search_simple__tw-check").css("background-position", "0 0");
        $("#search_simple__tw-cbx")[0].checked = false;        
    } else {
        $("#search_ext__tw-check").css("background-position", "-25px 0");    
        $("#search_ext__tw-cbx")[0].checked = true;        
        $("#search_simple__tw-check").css("background-position", "-25px 0");    
        $("#search_simple__tw-cbx")[0].checked = true;        
    }
})

// Чекбокс на форме авторизации

$("#modal-dialog-rmbr__check").click(function() {
    if ($("#modal-dialog-rmbr__cbx")[0].checked) {
        $("#modal-dialog-rmbr__check").css("background-position", "0 0");
        $("#modal-dialog-rmbr__cbx")[0].checked = false;        
    } else {
        $("#modal-dialog-rmbr__check").css("background-position", "-20px 0");    
        $("#modal-dialog-rmbr__cbx")[0].checked = true;        
    }
})

// Проверка правильности ввода email

function checkEmail(edit, flag) {
    var re = /^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/;
    var em = $("#" + edit).val();
    
    if (re.test(em)) {
        $("#" + flag).show();
        return true;
    } else {
        $("#" + flag).hide();
        return false;
    }
}

// для авторизации

$("#modal-dialog__edit_email-pre").keyup(function() {
    checkEmail($(this).attr("id"), "modal-dialog__email-ok-pre");
})

$("#modal-dialog__edit_email-pre").blur(function() {
    checkEmail($(this).attr("id"), "modal-dialog__email-ok-pre");
})

// для регистрации

$("#modal-dialog__edit_email-reg").keyup(function() {
    checkEmail($(this).attr("id"), "modal-dialog__email-ok-reg");
})

$("#modal-dialog__edit_email-reg").blur(function() {
    checkEmail($(this).attr("id"), "modal-dialog__email-ok-reg");
})

// для восстановления

$("#modal-dialog__edit_email-restore-psw").keyup(function() {
    checkEmail($(this).attr("id"), "modal-dialog__email-ok-restore-psw");
})

$("#modal-dialog__edit_email-restore-psw").blur(function() {
    checkEmail($(this).attr("id"), "modal-dialog__email-ok-restore-psw");
})

// Кнопка "Войти"

$("#pre-btn").click(function() {
    if (!checkEmail("modal-dialog__edit_email-pre", "modal-dialog__email-ok-pre")) {
        $("#modal-dialog__edit_email-pre").focus();
        return;
    }
    
    if ($("#modal-dialog__edit_psw-pre").val() == "") {
        $("#modal-dialog__edit_psw-pre").focus();
        return;
    }
})

// Проверка длины пароля

var pswCheckLength = 0;

$("#modal-dialog__edit_psw-reg").blur(function() {
    var psw = $(this).val();

    if (psw.length < 6) {
        $(".bibi-hint_psw-reg").show();
        $(this).css("background-color", "#fecbcb");
        pswCheckLength = 1;
    } else {
        $(".bibi-hint_psw-reg").hide();
        $(this).css("background-color", "#ffffff");
        pswCheckLength = 0;
    }
})

$("#modal-dialog__edit_psw-reg").keyup(function() {
    var psw = $(this).val();

    if ((pswCheckLength == 1) && (psw.length >= 6)) {
        $(".bibi-hint_psw-reg").hide();
        $(this).css("background-color", "#ffffff");
        pswCheckLength = 0;
    }
})

// Сравнение паролей

var pswIsEqual = 0;

function comparePasswords() {
    var psw = $("#modal-dialog__edit_psw-reg").val();
    var pswConfirm = $("#modal-dialog__edit_psw-confirm-reg").val();
    
    if (psw !== pswConfirm) {
        $(".bibi-hint_psw-confirm-reg").show();
        $("#modal-dialog__edit_psw-confirm-reg").css("background-color", "#fecbcb");
        pswIsEqual = 1;
        return false;
    } else {
        $(".bibi-hint_psw-confirm-reg").hide();
        $("#modal-dialog__edit_psw-confirm-reg").css("background-color", "#ffffff");
        pswIsEqual = 0;
        return true;
    }
}

$("#modal-dialog__edit_psw-confirm-reg").blur(function() {
    comparePasswords();
})

$("#modal-dialog__edit_psw-confirm-reg").keyup(function() {
    if (pswIsEqual == 1) {
        comparePasswords();
    }
})

// Кнопка "Зарегистрироваться"

$("#reg-btn").click(function() {
    if (!checkEmail("modal-dialog__edit_email-reg", "modal-dialog__email-ok-reg")) {
        $("#modal-dialog__edit_email-reg").focus();
        return;
    }
    
    if ($("#modal-dialog__edit_psw-reg").val() == "") {
        $("#modal-dialog__edit_psw-reg").focus();
        return;
    }

    if ($("#modal-dialog__edit_psw-confirm-reg").val() == "") {
        $("#modal-dialog__edit_psw-confirm-reg").focus();
        return;
    }
    
    if (!comparePasswords()) {
        return;
    }
})

// Кнопка "Восстановить пароль"

$("#restore-psw-btn").click(function() {
    if (!checkEmail("modal-dialog__edit_email-restore-psw", "modal-dialog__email-ok-restore-psw")) {
        $("#modal-dialog__edit_email-restore-psw").focus();
        return;
    }
})

// Кнопка "Мой город"

$(".city .bibi-list_city > li").click(function() {
    var cityID = $(this).attr("data-city-id");
    var cityName = $(this).children("a").html();
    
    $("#city__btn").attr("data-city-id", cityID);
    $("#city__btn").html(cityName);
    
    var coords = eval("(" + $(this).attr("data-city-coords") + ")");    
    showMap(coords);
})

// Форма простого поиска - кнопка "Марка"

$("#search_simple__brand-list > li").click(function() {
    var brandID = $(this).attr("data-brand-id");
    var brandName = $(this).children("a").html();
    
    $("#search_simple__brand").attr("data-brand-id", brandID);
    $("#search_simple__brand").html(brandName);
    $("#search_ext__brand").attr("data-brand-id", brandID);
    $("#search_ext__brand").html(brandName);
})

// Форма простого поиска - кнопка "Вид работы"

$("#search_simple__w-type-list > li").click(function() {
    var brandID = $(this).attr("data-w-type-id");
    var brandName = $(this).children("a").html();
    
    $("#search_simple__w-type").attr("data-w-type-id", brandID);
    $("#search_simple__w-type").html(brandName);
    $("#search_ext__w-type").attr("data-w-type-id", brandID);
    $("#search_ext__w-type").html(brandName);
})

// Форма расширенного поиска - кнопка "Марка"

$("#search_ext__brand-list > li").click(function() {
    var brandID = $(this).attr("data-brand-id");
    var brandName = $(this).children("a").html();
    
    $("#search_ext__brand").attr("data-brand-id", brandID);
    $("#search_ext__brand").html(brandName);
    $("#search_simple__brand").attr("data-brand-id", brandID);
    $("#search_simple__brand").html(brandName);
})

// Форма расширенного поиска - кнопка "Вид работы"

$("#search_ext__w-type-list > li").click(function() {
    var brandID = $(this).attr("data-w-type-id");
    var brandName = $(this).children("a").html();
    
    $("#search_ext__w-type").attr("data-w-type-id", brandID);
    $("#search_ext__w-type").html(brandName);
    $("#search_simple__w-type").attr("data-w-type-id", brandID);
    $("#search_simple__w-type").html(brandName);
})

// Форма расширенного поиска - кнопка "Район"

$("#search_ext__distr-list > li").click(function() {
    var brandID = $(this).attr("data-distr-id");
    var brandName = $(this).children("a").html();
    
    $("#search_ext__distr").attr("data-distr-id", brandID);
    $("#search_ext__distr").html(brandName);
})

// Слайдер

var slideWidth = 370;
var sliderTimer;
var sliderDirection = -1;
var sliderInterval = 5000;
var sliderAniTime = 1000;

$(function(){
    $('.slider-row_middle > .slider__viewport').width($('.slider-row_middle > .slider__viewport').children().size() * slideWidth);
    
    sliderTimer = setInterval(nextSlide, sliderInterval);
    
    $('.slider-row_middle > .slider__viewport').hover(function(){
        clearInterval(sliderTimer);
    },function(){
        sliderTimer = setInterval(nextSlide, sliderInterval);
    });

    $('.slider-row_middle > .arrow_left').hover(function(){
        clearInterval(sliderTimer);
    },function(){
        sliderTimer = setInterval(nextSlide, sliderInterval);
    });

    $('.slider-row_middle > .arrow_right').hover(function(){
        clearInterval(sliderTimer);
    },function(){
        sliderTimer = setInterval(nextSlide, sliderInterval);
    });
});

function animateSlide(cs) {
    $('.slider-row_top    > .slider__viewport').animate({left : 30 - cs * slideWidth}, sliderAniTime).data('current', cs);
    $('.slider-row_middle > .slider__viewport').animate({left : 30 - cs * slideWidth}, sliderAniTime).data('current', cs);
    $('.slider-row_bottom > .slider__viewport').animate({left : 30 - cs * slideWidth}, sliderAniTime).data('current', cs);
}

function nextSlide(){
    var currentSlide = parseInt($('.slider-row_middle > .slider__viewport').data('current'));
    
    if (sliderDirection == -1) {
        currentSlide++;
    } else {
        currentSlide--;
    }
    
    if ((currentSlide == 0) || (currentSlide == $('.slider-row_middle > .slider__viewport').children().size() - 3)) {
        sliderDirection = -sliderDirection;
    }
        
    animateSlide(currentSlide);
}

$(".arrow_left").click(function() {
    var currentSlide = parseInt($('.slider-row_middle > .slider__viewport').data('current'));
    currentSlide++;
    if (currentSlide > $('.slider-row_middle > .slider__viewport').children().size() - 3)
        return;
    animateSlide(currentSlide);
})

$(".arrow_right").click(function() {
    var currentSlide = parseInt($('.slider-row_middle > .slider__viewport').data('current'));
    currentSlide--;
    if (currentSlide < 0)
        return;
    animateSlide(currentSlide);
})

// Подсказка для кнопки "Забыли пароль"

$('.pre-btn-psw').hover(function(){
        $(".bibi-hint_psw-pre").show();
    },function(){
        $(".bibi-hint_psw-pre").hide();
    }
)

// Переключение диалогов

$("#modal-dialog__link-login").click(function() {
    setTimeout(function() { $("#pre").click(); }, 500);
})

$("#modal-dialog__link-reg").click(function() {
    setTimeout(function() { $("#reg").click(); }, 500);
})

$("#modal-dialog__restore-psw").click(function() {
    $(".bibi-hint_psw-pre").hide();
    setTimeout(function() { $("#rst").click(); }, 500);
})


