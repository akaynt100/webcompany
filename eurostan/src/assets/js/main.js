$(document).ready(function () {

    $('.about-slider').bxSlider({
        pagerCustom: '#about-slider-pager'
    });

    $('.slider-pager').bxSlider({
        infiniteLoop: false,
        pager: false,
        minSlides: 10,
        maxSlides: 10,
        moveSlides: 2,
        slideMargin: 5,
        slideWidth: 80,
        nextSelector: '#pager-control_right',
        prevSelector: '#pager-control_left',
        nextText: '',
        prevText: ''
    });


    $('.certificates-slider').bxSlider({
        infiniteLoop: false,
        minSlides: 5,
        maxSlides: 6,
        moveSlides: 2,
        slideMargin: 15,
        slideWidth: 180
    });

    $('.partners-slider').bxSlider({
        infiniteLoop: true,
        pager: false,
        minSlides: 6,
        maxSlides: 6,
        moveSlides: 2,
        slideMargin: 40,
        slideWidth: 165
    });
    $('#project-gallery').scrollGallery({
        mask: '.holder',
        slider: '.slideset',
        slides: 'li',
        btnPrev: 'a.btn-prev',
        btnNext: 'a.btn-next',
        circularRotation: false,
        autoRotation: false,
        switchTime: 3000,
        animSpeed: 500
    });
});


function popUpInit(){
    var el = $('.popup-overlay'),
        popUp = {
            overlay: el,
            registrationForm: el.find('.registration-form'),
            loginForm: el.find('.login-form'),
            reviewForm: el.find('.review-form'),
            feedbackForm: el.find('.feedback-form'),
            callbackForm: el.find('.user-callback-form'),
            serviceForm: el.find('.service-form')
        },
        closeBtns = el.find('.popup__close'),
        submitBtns = el.find('input[type=submit]');

    var hidePopUps = function () {
        for(var key in popUp){
            if(key != 'overlay') popUp[key].fadeOut();
        }
    };

    var hideOverlay = function () {
        popUp.overlay.fadeOut();
    };

    var hideAll = function () {
        hidePopUps();
        hideOverlay();
    };

    var preparation = function () {
        popUp.overlay.fadeIn('slow');
    };

    var bindSettings = function () {
        closeBtns.on('click' ,hideAll);

        submitBtns.on('click', function (e) {
            //e.preventDefault();
        });

    };

    return function () {
        bindSettings();

        return {
            showRegistrationForm: function(){
                preparation();
                popUp.registrationForm.fadeIn('slow');
                return popUp.registrationForm;
            },
            showLoginForm: function(){
                preparation();
                popUp.loginForm.fadeIn('slow');
                return popUp.loginForm;
            },
            showReviewForm: function(){
                preparation();
                popUp.reviewForm.fadeIn('slow');
                return popUp.reviewForm;
            },
            showFeedbackForm: function(){
                preparation();
                popUp.feedbackForm.fadeIn('slow');
                return popUp.feedbackForm;
            },
            showCallbackForm: function(title){
                preparation();
                //openServicePopUp(title);
                popUp.callbackForm.fadeIn('slow');
                return popUp.callbackForm;
            },
            showServiceForm: function(){
                preparation();
                popUp.serviceForm.fadeIn('slow');
                return popUp.serviceForm;
            }
        };
    }();
}

function mainSliderInit(){
    var sliderContainer = $(".main-slider-wrap"),
        slider = sliderContainer.find(".slider").bxSlider({
            pager: false
        });
    sliderContainer.find(".slider__controls-prev").click(function () {
        slider.goToPrevSlide();
    });
    sliderContainer.find(".slider__controls-next").click(function () {
        slider.goToNextSlide();
    });

    return slider;
}

function customInputFile(){
    var el = $(".custom-input-file");
    if(el.length){
        el.each(function(){
            var that = $(this);
            that.find("input[type='file']").change(function () {
                var file = $(this).val().replace(/\\/g, "/").split("/").pop();
                var textField = that.find(".custom-input-file__text");
                if(textField.attr("value")){
                    textField.val(file);
                }else{
                    textField.text(file);
                }
            });
        });
    }
}

function findParent(el,class_){
    var parent = el.parent();
    if(parent.hasClass(class_)){
        return parent;
    }
    else {
        return findParent(parent,class_);
    }
}