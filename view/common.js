var adaptUILayout=function(){var a=function(){var a={},b={width:window.screen.width,height:window.screen.height},c=window.navigator.appVersion,d=null,e=function(a){return a.constructor==String?c.indexOf(a)>-1:c.test(a)},f=function(b,c,d){b&&c&&(a[b]={key:c,size:d})},g=function(b){a[b]&&delete a[b]},h=function(){if(null!=d)return d;for(var c in a)if(e(a[c].key)){d=a[c].size;break}return null==d&&(d=b),d};return{add:f,del:g,cal:h}}(),b=function(b){var c,d,e,f,g,h,i;i=navigator.userAgent.toLowerCase(),isiOS=i.indexOf("ipad")>-1||i.indexOf("iphone")>-1,d=window.devicePixelRatio,c=a.cal().width,e=160*b/c*d,f=isiOS?"target-densitydpi=device-dpi, width="+b+"px, user-scalable=no":"target-densitydpi="+e+", width=device-width, user-scalable=no",g=document.getElementsByTagName("head"),h=document.createElement("meta"),h.name="viewport",h.content=f,g.length>0&&g[g.length-1].appendChild(h)};return{regulateScreen:a,adapt:b}}();adaptUILayout.adapt(320);

$(function(){
    if ('addEventListener' in document) {
        document.addEventListener('DOMContentLoaded', function () {
            FastClick.attach(document.body);
        }, false);
    }
    //var w = $(window).width();
    //var h = $(window).height();
    var baseP = 750/1206;
    var w = $("#container").width();
    var h = $("#container").height();

    drawLine();
    function drawLine(){

        var PIX = Math.PI*2/360;
        var cos = Math.cos(PIX*20);
        var sin = Math.sin(PIX*20);
        var bh = w*sin+h*cos;
        var bw = w*cos+h*sin;

        var pos = h*sin;
        var posT = pos*sin;
        var posL = -pos*cos;
        $(".line-part").width(bw);
        $(".line-part").height(bh);
        $(".line-part .line-mask").css({"top":posT,"left":posL});
        $(".line-part .line").css({"left":pos});
        var baseW, baseH;

        if(h*baseP>w){
            baseW=h*baseP;
            baseH=h;
        }else{
            baseW=w;
            baseH=w/baseP;
        }
        $(".native-size").css({"width":baseW,"height":baseH})
        var basePer = [34.42,8.46,16.91,40.21];

        var template = '<div class="line-part" style="width:'+bw+'px;height:'+bh+'px;">'+
                '<div class="line-mask" style="top:'+posT+'px;left:'+posL+'px;">'+
                    '<div class="line item" style="left:'+pos+'px;">'+
                        '<div class="line-set" style="width:'+baseW+'px;">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
        var count = basePer.length;
        var itemTop = 0;
        var sub;
        for(var i = count-1; i>=0 ; i--){
            var item = $(template);
            $("#s1line").append(item);
            sub = 100-itemTop-basePer[i];
            if(i==0){
                sub = 0;
            }
            var pHight = basePer[i]/100*baseH;

            //console.log(i+"||"+sub);
            item.find(".line-set").css({'height': pHight,'bottom':itemTop/100*baseH,'backgroundPosition':'right -'+(sub/100*baseH)+"px"})
            itemTop+=basePer[i];

        }

        $(".s1 .line").width(w);
        $(".s1 .line").height(h);



    }

    var viewMode = "width";
    var isWeixin = RegExp("MicroMessenger").test(navigator.userAgent) ? true : false;
    $(".swiper-slide").imgLoad({
        loadIng:function(total,count){
            var p = count/total;
            $(".progress-txt").html(parseInt(p*100)+"%");
            $(".progress").css("width",parseInt(170*p));
        },
        callback:function(){
            $(".progress").width(170);
            $(".progress-txt").html("100%");
            setTimeout(function(){
                $(".progress").removeAttr("style");
                $("#loading").removeClass("over").addClass("comp");
            },300)
            $(".swiper-slide>article").css("height",$(".swiper-main").height());
            var swiper = $('.swiper-container').swiper({
                paginationClickable: true,
                mode: 'vertical',
				//loop: true,
                onSlideChangeStart: function(){
                    console.log("- changeStart -");
                },
                onSlideChangeEnd: function(){
                    console.log("- changeEnd -");
                },
                        onSlideChangeEnd: function(swipe){
                            var i = swipe.activeIndex+1;
                            console.log("- changeEnd - And - Index "+swipe.activeIndex+" -");
                            $(".s"+i).removeClass("move-before");
                            if(swipe.activeIndex == 8){
                                $("#arrow").css("display","none");
                                swipe.destroy();
                            }else{
                        $("#arrow").css("display","block");
                    }
                },
                onSwiperCreated: function(swipe){
                    console.log("- onSwiperCreated -");
                    setTimeout(function(){$(".s1").removeClass("move-before")},1000);
                   swipe.swipeTo(0);
                }
            });
            setTimeout(function(){
                $("#loading").removeClass("ready").addClass("over");
                setTimeout(function(){
                    $("#loading").css("display","none");
                },600);
            },300);

        }
    })
});
$.fn.imgLoad = function(option){
    var _this = {
        noLoad : 'not-photo',
        loadClassName : 'img-load',
        loadProgress : 'load-pic',
        totalView : 0,
        callback : undefined,
        loadIng : undefined
    };
    $.extend(_this,option);
    var noLoad = _this.noLoad,
        loadProgress = _this.loadProgress,
        totalView = _this.totalView,
        obj = $(this),
        loadClassName = _this.loadClassName,
        loadingNow = 0,
        totalCount = 0;
    var obj = $(this);
    var sk = {
        endContent: 0,
        current: 0,
        imgs: [],
        checkLoad: function(){
            var count = 0;
            for(var i in sk.imgs){
                for(var childIndex in sk.imgs[i]){
                    var item = obj.eq(i).find("."+loadClassName).eq(childIndex);
                    var imgItem = sk.imgs[i][childIndex];
                    if(!totalView){
                        if(imgItem.complete && !item.hasClass("img-loaded")){
                            console.log(item[0].nodeName)
                            if(item[0].nodeName == "IMG"){
                                item.attr("src",imgItem.src);
                            }else{
                                item.css("backgroundImage","url("+imgItem.src+")");
                            }
                            count++;
                        }
                    }
                }
            }
            if(count == totalCount){
                console.log("Load Done!");
                if (typeof(_this.callback) != 'undefined') {
                    _this.callback.apply($("."+loadProgress), arguments);
                }
            } else {
                if (typeof(_this.loadIng) != 'undefined') {
                    _this.loadIng.apply($("."+loadProgress), [totalCount,count]);
                }
                setTimeout(sk.checkLoad, 250);
            }
        }
    }
    obj.each(function(i){
        var item = $(this).find("."+loadClassName);
        sk.imgs[i] = [];
        item.each(function(childIndex){
            sk.imgs[i][childIndex] = new Image();
            sk.imgs[i][childIndex].src = $(this).attr("data-src");
            console.log(i+"||"+childIndex+"||"+sk.imgs[i][childIndex].src);
            totalCount++;
        })
    });
    if(obj.length){
        sk.checkLoad();
    }
}
