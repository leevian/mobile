        function touchSatrtFunc(e) {  
            //evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等  
            var touch = e.touches[0]; //获取第一个触点  
            var x = Number(touch.pageX); //页面触点X坐标  
            var y = Number(touch.pageY); //页面触点Y坐标  
            //记录触点初始位置  
            startX = x;  
            startY = y;  
        }  

        function isMove(e){
            var touch = evt.touches[0]; //获取第一个触点  
            var x = Number(touch.pageX); //页面触点X坐标  
            var y = Number(touch.pageY); 
            if(x - startX == 0 && y-startY==0){
                return true
            }
        }
        var positionX;
        var positionY
        $('.btn1').bind("touchstart",function(e){
            positionX = e.originalEvent.changedTouches[0].clientX;
            positionY = e.originalEvent.changedTouches[0].clientY;
        }).bind('touchend',function(e){
            

            var endX = e.originalEvent.changedTouches[0].clientX;
            var endY = e.originalEvent.changedTouches[0].clientY;
            if (positionX - endX == 0 && positionY-endY==0) {  
                location.href= 'page1.html';
            }  
     
            
        })
        $('.btn2').bind("touchstart",function(e){
            positionX = e.originalEvent.changedTouches[0].clientX;
            positionY = e.originalEvent.changedTouches[0].clientY;
        }).bind('touchend',function(e){
            

            var endX = e.originalEvent.changedTouches[0].clientX;
            var endY = e.originalEvent.changedTouches[0].clientY;
            if (positionX - endX == 0 && positionY-endY==0) {  
                location.href= 'page2.html';
            }  
     
            
        })
        $('.btn3').bind("touchstart",function(e){
            positionX = e.originalEvent.changedTouches[0].clientX;
            positionY = e.originalEvent.changedTouches[0].clientY;
        }).bind('touchend',function(e){
            

            var endX = e.originalEvent.changedTouches[0].clientX;
            var endY = e.originalEvent.changedTouches[0].clientY;
            if (positionX - endX == 0 && positionY-endY==0) {  
                location.href= 'page3.html';
            }  
     
            
        })
        $('.btn4').bind("touchstart",function(e){
            positionX = e.originalEvent.changedTouches[0].clientX;
            positionY = e.originalEvent.changedTouches[0].clientY;
        }).bind('touchend',function(e){
            

            var endX = e.originalEvent.changedTouches[0].clientX;
            var endY = e.originalEvent.changedTouches[0].clientY;
            if (positionX - endX == 0 && positionY-endY==0) {  
                location.href= 'page4.html';
            }  
     
            
        })
        $('.btn5').bind("touchstart",function(e){
            positionX = e.originalEvent.changedTouches[0].clientX;
            positionY = e.originalEvent.changedTouches[0].clientY;
        }).bind('touchend',function(e){
            

            var endX = e.originalEvent.changedTouches[0].clientX;
            var endY = e.originalEvent.changedTouches[0].clientY;
            if (positionX - endX == 0 && positionY-endY==0) {  
                location.href= 'page5.html';
            }  
     
            
        })
        $(function(){
            var mySwiper;

            mySwiper = new Swiper('.swiper-container', {
                direction : 'vertical',
                onSlideChangeStart:function(swiper, progress){
                    
                    if( mySwiper.activeIndex == 0 ||mySwiper.activeIndex == 1 ){
                        $('.down').show();
                    }else{
                        $('.down').hide();
                    }

                }
            });

            var local_url = document.location.href; 
            //获取要取得的get参数位置
            var par = "go"
            var get = local_url.indexOf(par +"=");
            if(get == -1){
                return false;   
            }   
            //截取字符串
            var get_par = local_url.slice(par.length + get + 1);    
            //判断截取后的字符串是否还有其他get参数
            var nextPar = get_par.indexOf("&");
            if(nextPar != -1){
                get_par = get_par.slice(0, nextPar);
            }
            if(get_par==1){
                mySwiper.slideTo(2, 1000, false);
                
            }
        })