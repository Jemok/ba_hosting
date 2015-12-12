$(document).ready ->
	$('.hero-slider').slick
		autoplay: true,
		dots: false,
		arrows: false,
		fade: true,
		cssEase: 'linear'
	
	$(".global-container").niceScroll({touchbehavior:false,cursorcolor:"#fff",cursoropacitymax:1,cursorwidth:6,cursorborder:"0 solid #2848BE",cursorborderradius:"0",background:"rgba(255,255,255,.25)",autohidemode:"false"}).cursor.css({"background-image":"url(images/mac6scroll.png)"})