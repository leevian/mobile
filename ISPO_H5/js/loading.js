//mainsize

//loading
$(function () {
    var count = 0;
    var images = [
        'common/loading.jpg',
        'common/background_06.png',
        'index/swiper_1.jpg',
        'index/swiper_4.jpg',
        'index/background_02.jpg',
        'index/background_03.jpg',
        'index/background_01.jpg',
        'page1/background.jpg',
        'page1/background_1.jpg',
        'page1/background_2.jpg',
        'page1/background_3.jpg',
        'page1/background_4.jpg',
        'page1/background_5.jpg',
        'page1/swiper_1_1.jpg',
        'page1/swiper_1_2.jpg',
        'page2/background_1.jpg',
        'page2/background_2.jpg',
        'page2/background_3.jpg',
        'page2/background_5.jpg',
        'page2/background_4.jpg',
        'page2/background1.jpg',
        'page2/background2.jpg',
        'page2/background3.jpg',
        'page2/cut.gif',
        'page2/huaban_dong.gif',
        'page3/background_1.jpg',
        'page3/1.gif',
        'page3/background_2.jpg',
        'page3/background_5.jpg',
        'page3/background.png',
        'page3/background1.jpg',
        'page3/background2.jpg',
        'page3/background3.jpg',
        'page4/background_1.jpg',
        'page4/background_2.jpg',
        'page4/background_3.jpg',
        'page4/background_4.jpg',
        'page4/background_5.jpg',
        'page4/background.jpg',
        'page4/product_1_big.png',
        'page4/product_2_big.png',
        'page4/product_3_big.png',
        'page4/product_4_big.png',
        'page4/product_5_big.png',
        'page4/product_6_big.png',
        'page4/product_7_big.png',
        'page5/background.png',
        'page5/background_5.jpg',
        'page5/background_1.jpg',
        'page5/background_2.jpg',
        'page5/background_3.jpg',
        'page5/background_4.jpg',
        'page5/huanchuan.gif',
        'page5/jiangban.png',
        
    ];
    $.ajaxSetup({
        cache: true
    });
    var _length = images.length;
    images.forEach(function (file) {
        var _ = new Image();
        _.src = "./img/" + file;
        $(_).bind("load error", function () {
            count++;
            var percent = parseInt(100 * count / _length);
            // console.log(percent)
            $("#number").text( percent + '%');
            if (count === _length) {
                $("#load").hide();
                // $("#load ").html($(".textarea").val());
                $.getScript("./js/index.js");
                $(".swiper-container").addClass('show');
                $('.title').addClass('show')
                return;
            }

        });
    });
});