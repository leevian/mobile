<!DOCTYPE html>
<html class="ui-mobile">
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
		<script type="text/javascript" src="{{asset('/js/referrer-killer.js')}}"></script>
		<script type="text/javascript" src="{{asset('/js/simplecalendar.js')}}"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('/css/common.css') }}">
		<!-- <link rel="stylesheet" href="{{ asset('/css/style.css') }}"> -->
		<link rel="stylesheet" href="{{ asset('/css/style-personal.css') }}">
		
	</head>
	<body>
		<div class="content" data-role="page" id="content" >
			<p class="now-month common-month">7月29日</p>
			@foreach ($detialinfo as $key=>$val)
			<div class="con-day">
				<p class="common-month">{{$key}}</p>
				<ul>
					@foreach ($val as $k=>$v)
					<li>
						<em></em>
						

						<div class="data-left">{{$v['minute']}}</div>
						<div class="data-right">
							@if ($v['type'] === 'image')
							<strong>
   								<strong class="data-pic"data-src="{{$v['PicUrl']}}"></strong>
   							</strong>
							@elseif ($v['type'] === 'text')
							    {{$v['content']}}
							@endif
						</div>
					</li>
					@endforeach
					

					
				</ul>
			</div>

			@endforeach
		</div>
		<div id="pop-calender" data-role="page">
			<a class="close-btn"href="javascript:void(0);"> <img src="{{asset('/img/close.png')}}"> </a>
			<div class="container">
				
			    <div class="row">
			      <div class="col-md-6">
			        <div class="calendar hidden-print">
			          <header>
			            <h2 class="month"></h2>
			            <a class="btn-prev fontawesome-angle-left" href="#"></a>
			            <a class="btn-next fontawesome-angle-right" href="#"></a>
			          </header>
			          <table>
			            <thead class="event-days">
			              <tr></tr>
			            </thead>
			            <tbody class="event-calendar">
			              <tr class="1"></tr>
			              <tr class="2"></tr>
			              <tr class="3"></tr>
			              <tr class="4"></tr>
			              <tr class="5"></tr>
			            </tbody>
			          </table>
			          
			        </div>
			      </div>
			      
			    </div>
			    <div class="list">
		            
		        </div>
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


		$('.data-pic').filter(function(){
			var imgSrc = $(this).attr('data-src');
			showImg(imgSrc,$(this))
		})

		
		$('.calender-btn-box').click(function(){
			$('#pop-calender').show();
			
			document.addEventListener("touchmove",function(e){
			
			e.preventDefault();
			// e.stopPropagation();
			
			},false);
			
		})
		$('.close-btn').click(function(){
			console.log(1)
			$('#pop-calender').hide();
			document.addEventListener("touchmove",function(e){
			
			
			
			},false);

		})
	function showImg( url ,obj) {
        var frameid = 'frameimg' + Math.random();      
        window.img = '<img id="img" style="width:100%"src=\''+url+'?'+Math.random()+'\' /><script>window.onload = function() { parent.document.getElementById(\''+frameid+'\').height = document.getElementById(\'img\').height+\'px\'; }<'+'/script>';
        $(obj).append('<iframe id="'+frameid+'" src="javascript:parent.img;" frameBorder="0" scrolling="no" width="100%"></iframe>');
	}
	</script>
</html>
















