var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var players = {};

function onYouTubeIframeAPIReady() {
    $(".slick iframe").each(function (id) {
        var $iframe = $(this).get(0);
        if ($iframe) {
            players = new YT.Player($iframe, {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
    });
}
function onPlayerReady() {
    $('.slick').slick('slickPlay');
}
function onPlayerStateChange(obj) {
    if (obj.data == 1) {
        $('.slick').slick('slickPause');
    } else if (obj.data == 2) {
        $('.slick').slick('slickPlay');
    }
}

$(function () {
    // アンカーリンク
    $('a[href^=#]').click(function () {
        // スクロールの速度
        var speed = 500; // ミリ秒
        // アンカーの値取得
        var href = $(this).attr("href");
        // 移動先を取得
        var target = $(href == "#" || href == "" ? 'html' : href);
        // 移動先を数値で取得
        var header = $('header').height();
        //ヘッダーの高さを引く
        var position = target.offset().top - header;
        // スムーススクロール
        $('body,html').animate({
            scrollTop: position
        }, speed, 'swing');
        return false;
    });

    $(".main-slider").on("beforeChange", function (event, slick) {
        var currentSlide, player, command;
        currentSlide = $(slick.$slider).find(".slick-current");
        player = currentSlide.find("iframe").get(0);
        command = {
            "event": "command",
            "func": "stopVideo"
        };
        if (player != undefined) {
            player.contentWindow.postMessage(JSON.stringify(command), "*");
        }
    });


    $('.main-slider').slick({
        arrows: true,
        dots: false,
        autoplay: true,
    }
    );
});
