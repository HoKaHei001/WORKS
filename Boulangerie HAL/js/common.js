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
        autoplay: true, // 自動でスクロール
        autoplaySpeed: 0, // 自動再生のスライド切り替えまでの時間を設定
        speed: 5000, // スライドが流れる速度を設定
        cssEase: "linear", // スライドの流れ方を等速に設定
        slidesToShow: 4, // 表示するスライドの数
        swipe: false, // 操作による切り替えはさせない
        arrows: false, // 矢印非表示
        pauseOnFocus: false, // スライダーをフォーカスした時にスライドを停止させるか
        pauseOnHover: false, // スライダーにマウスホバーした時にスライドを停止させるか
        // responsive: [
        //     {
        //         breakpoint: 750,
        //         settings: {
        //             slidesToShow: 3, // 画面幅750px以下でスライド3枚表示
        //         }
        //     }
        // ]
    }
    );
});
