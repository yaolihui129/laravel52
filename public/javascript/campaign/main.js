$(document).ready(function() {
//	var h = $(window).height();
//	$(".carousel").height(h - 80 - 270);

	//内容信息导航吸顶	
	var navHeight = $("#navHeight").offset().top;
	var navFix = $("#myCarousel");
	$(window).scroll(function() {
		if($(this).scrollTop() > navHeight) {

			navFix.hide();
			$(".subNav").addClass("navFix");
		} else {
			navFix.show();
			$(".subNav").removeClass("navFix");
		}
	});
	$(".subNav").find("a").click(function(){
		$(this).addClass("active").siblings().removeClass("active")
	});

	//内容信息导航锚点
	$('.nav-wrap,.subNav').navScroll({
		mobileBreakpoint: 768,
		scrollSpy: true
	});
	
	$('.click-me').navScroll({
		navHeight: 0
	});
});
