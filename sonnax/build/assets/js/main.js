$(document).ready(function () {

    $("#main-page-slider").bxSlider(); // Слайдер на главной

    $("#news-slider-body").mThumbnailScroller({  // Вертикальный слайдер новостей
        axis:"y",
        type:"click-50",
        markup: {
            buttonsHTML:{
                up: '',
                down: ''
            }
        }
    });

    $("#news-slider__prev").click(function(){
        $(".news-slider #mTS_1_buttonUp").click();
    });
    $("#news-slider__next").click(function(){
        $(".news-slider #mTS_1_buttonDown").click();
    });

    $("#latest-products-slider").mThumbnailScroller({ // Слайдер товаров
        type:"click-50"
    });
    $("#latest-slider__next").click(function(){
        $(".latest-products-slider #mTS_2_buttonRight,.latest-products-slider #mTS_1_buttonRight").click();

    });
    $("#latest-slider__prev").click(function(){
        $(".latest-products-slider #mTS_2_buttonLeft,.latest-products-slider #mTS_1_buttonLeft").click();
    });

    $(window).scroll(function(){ // Появление блоков при прокрутке на главной странице
        var aboutBlock = document.querySelector("#main-page-about-block");

        if(aboutBlock && aboutBlock.getBoundingClientRect().top <= 150 && !$(aboutBlock).hasClass("about-advantages-showed")){
            setTimeout(function(){
                $(".about-advantage-el").addClass('about-advantage-el_show');
                $(aboutBlock).addClass("about-advantages-showed");
            },1000);
        }
    });

    $(".custom-scroll-block").mCustomScrollbar();  // Кастомный скрол

    customInputFile(); // Кастомная загрузка файла в личном кабинете

    $(".phone-mask").mask("+0000000000",{placeholder: "+ _ _ _ _ _ _ _ _ _ _"});

    $(".product__main-images-list").bxSlider({  // Слайдер на странице товара
        pagerCustom: '#product-images-thumbs',
        nextSelector: '#product-gal-controls-next',
        prevSelector: '#product-gal-controls-prev',
        nextText: '',
        prevText: ''
    });

    //$(".zoom_image").trianZoom(); // Зум фото на странице товара

    zoom();

    $(".product-tabs-wrap").productTabs(2); // Табы на странице товара

    popUpsInit(); // Инициализация pop-up

    $(".footer-top-subscribe").on("click", function (e) {
        e.preventDefault();
        $(this).hide().siblings(".registration-form").show();
    });

    ordersToggle();
});

function customInputFile(){
    var el = $(".custom-input-file");
    if(el.length){
        el.each(function(){
            var that = $(this);
            that.find("input[type='file']").change(function () {
                var file = $(this).val().replace(/\\/g, "/").split("/").pop();
                that.find(".custom-input-file__text").text(file);
            });
        });
    }
}

function popUpsInit(){
    $(".signin-popup").click(function (e) {
        var popup = $(".login-popup"),
            form = popup.find(".popup-wrap"),
            closeBtn = popup.find(".popup-close");

        $("body").addClass("scroll_disable");
        popup.show().css({"top": $(window).scrollTop()});
        form.css({"top": (($(window).height() - form.height())/2) });
        closeBtn.click(function () {
            popup.hide();
            $("body").removeClass("scroll_disable");
        });

        e.preventDefault();
    });

    $(".get__offer").click(function (e) {
        var popup = $(".login-offer"),
            form = popup.find(".popup-wrap"),
            closeBtn = popup.find(".popup-close");

        $("body").addClass("scroll_disable");
        popup.show().css({"top": $(window).scrollTop()});
        form.css({"top": (($(window).height() - form.height())/2) });
        closeBtn.click(function () {
            popup.hide();
            $("body").removeClass("scroll_disable");
        });

        e.preventDefault();
    });
}

function zoom(){
    return $(".zoom_image").trianZoom(); // Зум фото на странице товара
}

function ordersToggle(){
    var els = $('[data-order]');

    if(els.length){
        els.on("click", function () {
            $("[data-order-detail = '"+$(this).data("order")+"']").slideToggle("slow");
            toggleImg($(this));
        });
    }

    var toggleImg = function (el) {
        var closeSrc = 'assets/images/order-close.png',
            openSrc = 'assets/images/order-open.png';

        (el.attr('src') == closeSrc) ? el.attr('src', openSrc) : el.attr('src', closeSrc);
    };
}