$(document).ready(function () {
    var showNavFlag = true;

    //if (navigator.appVersion.indexOf("Mac")!=-1) $("html").addClass("mac-os");

    $(".mouse").on("click", function () {
        $(window).scrollTo($('#about-block'),500);
    });

    $(window).scroll(function () {
        if (document.querySelector("#about-block").getBoundingClientRect().top <= 0 && showNavFlag && $(window).width() > 768){
            //$(".header").hide().slideDown("slow", function () {
            //    $(this).addClass("sticky_header");
            //});
            $(".header").addClass("sticky_header");
            showNavFlag = false;
        }

        if (document.querySelector(".top-banner").getBoundingClientRect().top == 0 && $(window).width() > 768){
            console.log('asdad');
            $(".header").removeClass("sticky_header");
            showNavFlag = true;
        }
    });

    $(".nav__list-item-link, .top-banner__content-btns .btn, .services__btns-wrap .btn").on('click', function (e) {
        e.preventDefault();
        var el = $(this).attr('href'),
            distance = $(el).offset().top - $(".header").height();
        $(window).scrollTo(distance , 500,{axis: 'y'});
    });


    var popUps = popUpInit(); // Инициализация попапов

    // popUps.showSuccessWindow(); - Показать окно успеха при успешном ajax-запросе отправки формы в попапе

    $('.competition__popup').on('click', function (e) {
        popUps.showCompetitionForm();
        e.preventDefault();
    });
    $('.fast__service-popup').on('click', function (e) {
        popUps.showFastServiceForm();
        e.preventDefault();
    });
    $('.full__service-popup').on('click', function (e) {
        popUps.showFullServiceForm();
        e.preventDefault();
    });
    $('.vip__service-popup').on('click', function (e) {
        popUps.showVipServiceForm();
        e.preventDefault();
    });
    $('.show__repair-form').on('click', function (e) {
        var title = $(this).data('popupTitle');
        popUps.showRepairForm(title);
        e.preventDefault();
    });
    $('.price__table-popup').on('click', function (e) {
        var priceTable = popUps.showPriceTable();
        priceTable.css("top",
            ($(window).height()-priceTable.height())/2
        );
        e.preventDefault();
    });


    if($(window).width() <= 768){
        $('.hamburger__box').on('click', function () {
            $('.mobile__nav .nav__list').addClass('nav__list-opened');
            $('.mobile__nav .nav__close').addClass('nav__close-opened').on('click', function () {
                $(this).removeClass('nav__close-opened');
                $('.mobile__nav .nav__list').removeClass('nav__list-opened');
            });
        });
    }
});


function popUpInit(){
    var el = $('.popup-overlay'),
        popUp = {
            overlay: el,
            competitionForm: el.find('.competition-form'),
            fastServiceForm: el.find('.fast-service-form'),
            fullServiceForm: el.find('.full-service-form'),
            vipServiceForm: el.find('.vip-service-form'),
            repairForm: el.find('.repair-form'),
            priceTable: el.find('.prices')
        },
        closeBtns = el.find('.popup__close'),
        submitBtns = el.find('.cta__form-submit'),
        successWindow = el.find('.success');

    var hidePopUps = function () {
        for(var key in popUp){
            if(key != 'overlay') popUp[key].fadeOut();
        }
        successWindow.fadeOut();
    };

    var hideOverlay = function () {
        popUp.overlay.fadeOut();
        //$('body').removeClass('scroll-disable');
    };

    var hideAll = function () {
        hidePopUps();
        hideOverlay();
    };

    var preparation = function () {
        hideAll();
        //$('body').addClass('scroll-disable');
        popUp.overlay.fadeIn('slow');
    };

    var bindSettings = function () {
        closeBtns.on('click' ,hideAll);

        submitBtns.on('click', function (e) {
            showSuccessWindow();
            e.preventDefault();
        });

    };

    var showSuccessWindow = function () {
        hidePopUps();
        successWindow.show();
        setTimeout(function () {
            hideAll();
        },2000);
    };

    var openServicePopUp = function (title_) {
        var title = popUp.repairForm.find('.cta__title-b');
        title.html(title_);
        popUp.repairForm.fadeIn('slow');
    };

    return function () {
        bindSettings();

        return {
            showCompetitionForm: function(){
                preparation();
                popUp.competitionForm.fadeIn('slow');
                return popUp.competitionForm;
            },
            showFastServiceForm: function(){
                preparation();
                popUp.fastServiceForm.fadeIn('slow');
                return popUp.fastServiceForm;
            },
            showFullServiceForm: function(){
                preparation();
                popUp.fullServiceForm.fadeIn('slow');
                return popUp.fullServiceForm;
            },
            showVipServiceForm: function(){
                preparation();
                popUp.vipServiceForm.fadeIn('slow');
                return popUp.vipServiceForm;
            },
            showRepairForm: function(title){
                preparation();
                openServicePopUp(title);
                return popUp.repairForm;
            },
            showPriceTable: function(){
                preparation();
                popUp.priceTable.fadeIn('slow');
                return popUp.priceTable;
            },
            showSuccessWindow: showSuccessWindow
        };
    }();
}