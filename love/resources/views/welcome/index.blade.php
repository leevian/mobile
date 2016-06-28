<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>七月来上海，寻找你志同“色”合的小伙伴｜七月ISPO周</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1,user-scalable=no">
		<!-- 禁止浏览器从本地缓存中调阅页面。--> 
		<meta http-equiv="pragram" content="no-cache"> 
		<!--网页不保存在缓存中，每次访问都刷新页面。--> 
		<meta http-equiv="cache-control" content="no-cache, must-revalidate"> 
		<!--同上面意思差不多，必须重新加载页面--> 
		<meta http-equiv="expires" content="0"> 
		<!-- Mobile Devices Support @begin -->
		<meta content="telephone=no, address=no" name="format-detection">
		<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<script type="text/javascript" src="{{asset('/js/jquery-2.2.0.js')}}"></script>

		<script type="text/javascript" src="{{asset('/js/jquery.mobile-1.4.5.min.js')}}"></script>
	
		
		<link rel="stylesheet" href="{{ asset('/css/common.css') }}">
		
	</head>
	<body>
		<div class="top-info" data-role="head">
			<div class="face-box">
				<a href=""><img class="face-info face-left"src="{{ asset('/img/face1.png') }}"></a>
				<a href=""><img class="face-info face-right"src="{{ asset('/img/face2.jpg') }}"></a>
			</div>
			
			<a href=""><img class="calendar-btn" src="{{ asset('/img/calender.png') }}"></a>
		</div>
		<div class="content" data-role="page" id="content">
			<p class="now-month common-month">7月29日</p>
			<div class="con-day">
				<p class="common-month">7月29日</p>
				<ul>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right"><img class="data-pic" src="img/calender.png"></div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>

					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>

					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
				</ul>
			</div>
			<div class="con-day">
				<p class="common-month">7月30日</p>
				<ul>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right"><img class="data-pic" src="img/calender.png"></div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>

					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>

					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
					<li>
						<em></em>
						<div class="data-left">10:20</div>
						<div class="data-right">ffdfdfd</div>
					</li>
				</ul>
			</div>
		</div>
	</body>
	<script>
		$(document).ready(function(){
			var headTop = $('.top-info').height();
			$('li:last').each(function(){
				$(this).find('em').remove();

			})

		　　$(document).scroll(function(event) {
				var windowTop = $(window).scrollTop();
					
					
					 
					
				if(windowTop>headTop){
				  $('.now-month').addClass('show')
				  	// $.mobile.silentScroll(headTop)
				}else{
				  $('.now-month').removeClass('show')

				}
		       	$('.con-day').each(function () {
		       		var thisTop = $(this).offset().top;
		       		var thisHeight = $(this).height();
		       		var thisBottom = thisTop+thisHeight;
		       		var day = $(this).find('.common-month').text();
		       		if(windowTop>thisTop && windowTop<thisBottom){
		       			$('.now-month').html(day)
		       		}
		       	})
	    		 	
			
			})

			
			
		});
		
	</script>
</html>
















