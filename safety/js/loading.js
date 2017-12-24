//mainsize

//loading
$(function () {
    var count = 0;
    var images = [
        '0.png',
        '1.png',
        '2.png',
        '3.png',
        '4.png',
        '5.png',
        '6.png',
        '7.png',
        '8.png',
        '9.png',
        's1.mp4',
        's2.mp4',
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
    var local_url = document.location.href; 
            //获取要取得的get参数位置
    var par = "go"
    var get = local_url.indexOf(par +"=");
    
    //截取字符串
    var get_par = local_url.slice(par.length + get + 1);    
    //判断截取后的字符串是否还有其他get参数
    var nextPar = get_par.indexOf("&");
    if(nextPar != -1){
        get_par = get_par.slice(0, nextPar);
    }
    console.log(get_par)
    if(get_par!=1){
        images.forEach(function (file) {
        var _ = new Image();
        _.src = "./img/" + file;
        $(_).bind("load error", function () {
            count++;
            var percent = parseInt(100 * count / _length);
            // console.log(percent)
            $("#number").text( percent + '%');
            if (count === _length) {
                // $("#load").hide();
                // $("#load ").html($(".textarea").val());
                // $.getScript("./js/index.js");
                // $(".swiper-container").addClass('show');
                $(".start").removeClass('hide').addClass('show');
                console.log(1)
                // $('.title').addClass('show')

                return;
            }

        });
    });             
    }else{
       // $("#load").hide();
        // $("#load ").html($(".textarea").val());

    }

    
});