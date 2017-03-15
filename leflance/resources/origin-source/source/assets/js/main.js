$(document).ready(function () {
    gradientInit();
    setNotificationCountPosition();
    formUiInit();
    asideAccordion();
    closeBtnInit('.response-close-btn', 'response');

    progressBarInit();

    $('.order .action-btns-container').each(function () {
        var btns = $(this).find('.btn');
        if(!btns.length){
            $(this).hide();
        }
    });
});

function progressBarInit(){
    var bars = $('.progressbar-wrap');
    bars.each(function () {
        var value = $(this).data('progressStatus'),
            progressBar = $(this).find('.progressbar-overlay'),
            inWorkPoint = $(this).find('.progress-point-active-in-work'),
            completedPoint = $(this).find('.progress-point-active-completed');

        progressBar.animate({width: 100 - +value + '%'}, 1000);

        setTimeout(function () {
            if( +value >= 50)
                inWorkPoint.addClass('progress-point-active');

        },500);
        setTimeout(function () {
            if( +value == 100 )
                completedPoint.addClass('progress-point-active');
        },850);
    });
}

function closeBtnInit(btn, parentToHide){
    $('body').on('click', btn, function () {
        findParent($(this), parentToHide).slideUp();
    });
}

function asideAccordion(){
    var els = $('.group-with-categories .group__title-wrap, .user-nav-item-with-subnav > .user-nav-item__title-wrap');
    els.on('click', function () {
        var parent = $(this).parent();
        $(this).toggleClass('user-nav-item__active');
        parent.find('.group__title, .user-nav-item__title').toggleClass('spin-arrow');
        parent.find('.group-categories, .user-subnav-list').slideToggle(500);
    });

    els.click();
}

function formUiInit(){
    customPlaceholderInit();
    $('.custom-select').selectric();
    customInputFiles();
}

function customPlaceholderInit(){
    var els = $('.custom-placeholder-wrap');
    els.each(function () {
        $(this).on('click', clickHandler);
        $(this).find('input, textarea').on('focus', focusHandler);
    });

    textareaDetect();

    function textareaDetect(){
        els.each(function () {
            var textarea = $(this).find('textarea');
            if(textarea.length){
                $(this).find('.custom-placeholder').addClass('textarea-custom-placeholder');
            }
        });
    }

    function clickHandler(e) {
        var el = findParent($(e.target),'custom-placeholder-wrap'),
            input = el.find('input, textarea');
        el.addClass('custom-placeholder-active');
        input
            .focus()
            .focusout(function () {
                var val = $(this).val().trim();
                if(!val){
                    el.removeClass('custom-placeholder-active');
                }
            });
    }

    function focusHandler(e){
        var el = findParent($(e.target),'custom-placeholder-wrap');
        el.addClass('custom-placeholder-active');
        $(e.target).focusout(function () {
            var val = $(this).val().trim();
            if(!val){
                el.removeClass('custom-placeholder-active');
            }
        });
    }
}

function setNotificationCountPosition(){
    var els = $('.notifications__count');
    els.each(function () {
        var el = $(this),
            width = el.innerWidth();
        if(width < 22){
            el.css('right','-60%');
        }
        if(width > 28){
            el.css('right','-150%');
        }
        if(width < 28 && width >22){
            el.css('right','-110%');
        }
    });
}

function gradientInit(){
    var colors = [
            [76,175,80],
            [47,172,203],
            [33,150,243],
            [76,175,80],
            [47,172,203],
            [33,150,243]
        ],
        step = 0,
        colorIndices = [0,1,2,3],
        gradientSpeed = 0.002;

    function updateGradient() {

        if ( $===undefined ) return;

        var c0_0 = colors[colorIndices[0]];
        var c0_1 = colors[colorIndices[1]];
        var c1_0 = colors[colorIndices[2]];
        var c1_1 = colors[colorIndices[3]];

        var istep = 1 - step;
        var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
        var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
        var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
        var color1 = "rgb("+r1+","+g1+","+b1+")";

        var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
        var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
        var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
        var color2 = "rgb("+r2+","+g2+","+b2+")";

        $('.gradient_theme-animated')
            .css({ background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"})
            .css({ background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"})
            .css({ background: "gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"})
            .css({ background: "linear-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"});


        step += gradientSpeed;
        if ( step >= 1 )
        {
            step %= 1;
            colorIndices[0] = colorIndices[1];
            colorIndices[2] = colorIndices[3];

            colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
            colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;

        }
    }

    setInterval(updateGradient,10);
}

function customInputFiles(){
    document.querySelectorAll('.custom-input-file').forEach(function (item) {
        item.querySelector('input[type=file]').onchange = function (e) {
            var files = this.files,
                namesContainer = item.querySelector('.custom-input-file__text');
            if(files.length){
                namesContainer.innerHTML = '';
                for(var i=0; i<files.length; i++){
                    var fileContainer = document.createElement('span'),
                        fileName = document.createElement('span'),
                        fileSizeContainer = document.createElement('span'),
                        fileSizeMb = (files[i].size/1000000).toFixed(3);
                    fileContainer.className = 'custom-input-file__item';
                    fileName.className = 'custom-input-file__item-name';
                    fileName.innerText = files[i].name;
                    fileSizeContainer.innerText = fileSizeMb + ' МБ';
                    fileContainer.appendChild(fileName);
                    fileContainer.appendChild(fileSizeContainer);
                    namesContainer.appendChild(fileContainer);
                }
            }
        };
    });
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



