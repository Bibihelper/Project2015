window.onload = init;

function init()
{
    var m = new Map("map");
    m.showMap(63.31268278, 103.42773438);
    
    VK.init({apiId: 5050952, onlyWidgets: true});
    VK.Widgets.Like("vk_like", {type: "mini", height: 24});
}

// Переключение между формами простого и расширенного поиска

$("#ext-search-btn").click(function() {
    $(".search_simple").hide("slow");
    $(".search_ext").show("slow");
});

$("#simple-search-btn").click(function() {
    $(".search_ext").hide("slow");
    $(".search_simple").show("slow");
});

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
});

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
});

// Кнопка "Мой город"

$(".city .bibi-list_city > li").click(function() {
    var cityID = $(this).attr("data-city-id");
    var cityName = $(this).children("a").html();
    
    $("#city__btn").attr("data-city-id", cityID);
    $("#city__btn").html(cityName);
    
    var coords = eval("(" + $(this).attr("data-city-coords") + ")");    
    showMap(coords);
});

// Форма простого поиска - кнопка "Марка"

$("#search_simple__brand-list > li").click(function() {
    var brandID = $(this).attr("data-brand-id");
    var brandName = $(this).children("a").html();
    
    $("#search_simple__brand").attr("data-brand-id", brandID);
    $("#search_simple__brand").html(brandName);
    $("#search_ext__brand").attr("data-brand-id", brandID);
    $("#search_ext__brand").html(brandName);
});

// Форма простого поиска - кнопка "Вид работы"

$("#search_simple__w-type-list > li").click(function() {
    var brandID = $(this).attr("data-w-type-id");
    var brandName = $(this).children("a").html();
    
    $("#search_simple__w-type").attr("data-w-type-id", brandID);
    $("#search_simple__w-type").html(brandName);
    $("#search_ext__w-type").attr("data-w-type-id", brandID);
    $("#search_ext__w-type").html(brandName);
});

// Форма расширенного поиска - кнопка "Марка"

$("#search_ext__brand-list > li").click(function() {
    var brandID = $(this).attr("data-brand-id");
    var brandName = $(this).children("a").html();
    
    $("#search_ext__brand").attr("data-brand-id", brandID);
    $("#search_ext__brand").html(brandName);
    $("#search_simple__brand").attr("data-brand-id", brandID);
    $("#search_simple__brand").html(brandName);
});

// Форма расширенного поиска - кнопка "Вид работы"

$("#search_ext__w-type-list > li").click(function() {
    var brandID = $(this).attr("data-w-type-id");
    var brandName = $(this).children("a").html();
    
    $("#search_ext__w-type").attr("data-w-type-id", brandID);
    $("#search_ext__w-type").html(brandName);
    $("#search_simple__w-type").attr("data-w-type-id", brandID);
    $("#search_simple__w-type").html(brandName);
});

// Форма расширенного поиска - кнопка "Район"

$("#search_ext__distr-list > li").click(function() {
    var brandID = $(this).attr("data-distr-id");
    var brandName = $(this).children("a").html();
    
    $("#search_ext__distr").attr("data-distr-id", brandID);
    $("#search_ext__distr").html(brandName);
});

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
    var slideCount   = $('.slider-row_middle > .slider__viewport').children().size();
    
    if (sliderDirection === -1) {
        currentSlide++;
    } else {
        currentSlide--;
    }
    
    if ((currentSlide <= 0) || (currentSlide >= slideCount - 3)) {
        sliderDirection = -sliderDirection;
    }
    
    currentSlide = (currentSlide < 0) ? 0 : currentSlide;
    currentSlide = (currentSlide > slideCount - 3) ? slideCount - 3 : currentSlide;
        
    animateSlide(currentSlide);
}

$(".arrow_left").click(function() {
    var currentSlide = parseInt($('.slider-row_middle > .slider__viewport').data('current'));
    var slideCount   = $('.slider-row_middle > .slider__viewport').children().size();
    if (currentSlide >= slideCount - 3)
        return;
    currentSlide++;
    animateSlide(currentSlide);
});

$(".arrow_right").click(function() {
    var currentSlide = parseInt($('.slider-row_middle > .slider__viewport').data('current'));
    if (currentSlide <= 0)
        return;
    currentSlide--;
    animateSlide(currentSlide);
});


