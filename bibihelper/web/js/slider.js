/* Slider */

var slideWidth = 370;
var sliderTimer;
var sliderDirection = -1;
var sliderInterval = 5000;
var sliderAniTime = 1000;

function initSlider() {
    $('div.slider-row-middle > ul.slider-viewport').width($('div.slider-row-middle > ul.slider-viewport').children().size() * slideWidth);
    
    sliderTimer = setInterval(nextSlide, sliderInterval);
    
    $('div.slider-row-middle > ul.slider-viewport').hover(function() {
        clearInterval(sliderTimer);
    },function(){
        sliderTimer = setInterval(nextSlide, sliderInterval);
    });

    $('div.slider-row-middle > .arrow_left').hover(function() {
        clearInterval(sliderTimer);
    },function(){
        sliderTimer = setInterval(nextSlide, sliderInterval);
    });

    $('div.slider-row-middle > .arrow_right').hover(function() {
        clearInterval(sliderTimer);
    },function(){
        sliderTimer = setInterval(nextSlide, sliderInterval);
    });
}

function animateSlide(cs) {
    $('div.slider-row-top    > ul.slider-viewport').animate({left : 30 - cs * slideWidth}, sliderAniTime).data('current', cs);
    $('div.slider-row-middle > ul.slider-viewport').animate({left : 30 - cs * slideWidth}, sliderAniTime).data('current', cs);
    $('div.slider-row-bottom > ul.slider-viewport').animate({left : 30 - cs * slideWidth}, sliderAniTime).data('current', cs);
}

function nextSlide(){
    var currentSlide = parseInt($('div.slider-row-middle > ul.slider-viewport').data('current'));
    var slideCount   = $('div.slider-row-middle > ul.slider-viewport').children().size();
    
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
    var currentSlide = parseInt($('div.slider-row-middle > ul.slider-viewport').data('current'));
    var slideCount   = $('div.slider-row-middle > ul.slider-viewport').children().size();
    if (currentSlide >= slideCount - 3)
        return;
    currentSlide++;
    animateSlide(currentSlide);
});

$(".arrow_right").click(function() {
    var currentSlide = parseInt($('div.slider-row-middle > ul.slider-viewport').data('current'));
    if (currentSlide <= 0)
        return;
    currentSlide--;
    animateSlide(currentSlide);
});




