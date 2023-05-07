function animationTrigger() {


    $('.slide-left-Trigger').each(function () {
        var elemPos = $(this).offset().top - 50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-left');
        }
    });

    $('.slide-right-Trigger').each(function () {
        var elemPos = $(this).offset().top - 50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-right');
        }
    });

    $('.slide-right2-Trigger').each(function () {
        var elemPos = $(this).offset().top + 50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-right2');
        }
    });

    $('.slide-in-bottom-Trigger').each(function () {
        var elemPos = $(this).offset().top + 100;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-in-bottom');
        }
    });

    $('.slide-in-bottom2-Trigger').each(function () {
        var elemPos = $(this).offset().top + 50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-in-bottom2');
        }
    });

    $('.slide-in-bottom3-Trigger').each(function () {
        var elemPos = $(this).offset().top + 50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-in-bottom3');
        }
    });

    $('.slide-in-bottom4-Trigger').each(function () {
        var elemPos = $(this).offset().top + 100;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-in-bottom4');
        }
    });

    $('.slide-in-bottom5-Trigger').each(function () {
        var elemPos = $(this).offset().top + 100;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-in-bottom5');
        }
    });

    $('.slide-in-bottom6-Trigger').each(function () {
        var elemPos = $(this).offset().top + 100;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('slide-in-bottom6');
        }
    });

    $('.clip-X-Trigger').each(function () {
        var elemPos = $(this).offset().top + 50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
            $(this).addClass('clip-X ');
        }
    });


}


$(window).scroll(function () {
    animationTrigger();
});

$(window).on('load', function () {
    animationTrigger();

});