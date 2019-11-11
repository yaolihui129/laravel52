$(function(){
	/*侧边栏导航*/
 	$("ul.first-nav>a").click(function(){
 		$(this).siblings('ol,ul').find('li').removeClass("active");  
 		$(this).parents().siblings('ol,ul').find('li').removeClass("active");  
 		$(this).addClass("active").parents("ul").siblings("ul.first-nav").find("a").removeClass("active");

 	});
 	$("ol.second-nav li").click(function(){
 		$(this).parent().parents("ul").find('a').removeClass("active");
 		$(this).parents("ul.first-nav").siblings().find("a").removeClass("active");
 		$(this).parents("ul.first-nav").siblings().find("ol li").removeClass("active");
 		//alert(0)
 		$(this).addClass("active").siblings().removeClass("active");
 		
 	});


 	$(".popup-report .tab li").click(function(){
 		$(this).addClass("cur").siblings().removeClass("cur")
 	});
 	$(".popup-report .step .tabs li").click(function(){
 		$(this).addClass("cur").siblings().removeClass("cur")
 	});

 	$(".close-btn").click(function(){
 		$(".popup-bg,.popup-content").hide();
 	});

 	var height = $(".content").height();
 	$(".nav-list").css({
 		"height": height + "px"
 	});
 	$(".module .list").css({
 		"height": height -80 + "px" 
 	});


 	$(".jiegou h3").click(function(){
 		$(this).find("span").toggleClass("active");
 		$(".jiegou .list").toggle();
 	});


 	$(".bowser li").click(function(){
 		$(this).addClass("active")
 	});

 	$(".sort li").click(function(){
 		$(this).addClass("active").siblings().removeClass("active")
 	});

 	var hei = $(".popup-auto-task-list table").height();
 	$(".sort").css({
 		"height": hei + "px"
 	});

 	$(".nav-uls ul li").click(function(){
 		$(this).parent().parent().find('li').removeClass("active");
 		$(this).addClass("active");

 		/*.parent().siblings().find("li").removeClass("active");*/
 	});
	$(".nav-uls ul ol li").click(function(){
	$(".nav-uls ul li").removeClass("active");
	$(this).addClass("active");

	/*.parent().siblings().find("li").removeClass("active");*/
 	});

 	/*任务执行弹窗  发送邮件*/
 	$(".email .nosend input").click(function(){
 		$(".emails").hide()
 	});
 	$(".email .send").click(function(){
 		$(".emails").show()
 	});

 	$(".icon.arrow").click(function(){
 		$(".select").toggle()
 	});

 	$(function() {
	  $('.radio-btn').click(function(){
	  	
	     /*$("this").addClass("checked").parents("li").siblings().find(".radio-btn").removeClass("checked")*/
	  });
	});
});