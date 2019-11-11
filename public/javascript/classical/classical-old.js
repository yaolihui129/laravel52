var DATA;
var ops;
var leftMenu;
var treeMenus;

$(function() {
	$(window).resize(function() {
		Deskpanel.resizeWindow();
	});
	CommonUtil.requestService("/desktop/menus", "", true, "get", function(data,
			status) {
		if (data.success) {// 成功
			DATA = CommonUtil.parseToJson(data.allmenus.DATA);
			ops = data.allmenus.ops;
			leftMenu = data.allmenus.leftMenu;
			treeMenus = CommonUtil.parseToJson(data.allmenus.treeMenus);
			Deskpanel.init();
			Navbar.init();
			if (self != top)// 若不是在IFrame中 则刷新当前页面 （登录超时时 刷新）
				parent.location.reload();
		} else {
		}
	}, function(error) {
	});
	$("#osetting").on("click", function() {
		var requestData = {
			"osdisplay" : 1
		};
		UserUtil.updateUserOSDisplay(requestData);
	});
});

// 面板类
Deskpanel = function(me) {
	return me = {
		init : function() {
			me.resizeWindow();
		},
		resizeWindow : function() {
			// 根据浏览器的大小 控制背景图片的大小
			var height = $(window).height();
			var width = $(window).width();
			$("#leftFrame").css("height", height - 88);
			$("#rightFrame").css("height", height - 88);
			$("#rightFrame").css("width", width - 187);
		}
	}
}();
// 导航类
Navbar = function(me) {
	return me = {
		initOwn : function() {
			$("#rightFrame").html('');
			$("#rightFrame")
					.append(
							"<div class='place'><span>位置：</span><ul class='placeul'>"
									+ "<li><a href='#' id='parentpos'></a></li><li><a href='#' id='currentpos'></a></li></ul></div>");
			$("#rightFrame")
					.append(
							"<iframe id='rigFrame' name='rigFrame' src='' frameborder='no' border='no' marginwidth='0' "
									+ "marginheight='0' allowtransparency='true' scrolling='auto'>1212 </iframe>");
		},
		init : function() {
			me.initOwn();
			me.create();
			me.bindEvent();
		},
		create : function() {
			me.changeTab();
			me.createTopNavbar();// 上导航
			me.createLeftNavbar();// 左导航
		},
		createTopNavbar : function() {
			var classfiies = DATA.menu;
			for ( var i = 0; i < classfiies.length; i++) {
				var selected = "";
				if (i == 0)
					selected = "selected";
				var cls = classfiies[i];
				$(".nav").append(
						"<li><a tabId='" + cls.code
								+ "' href='#' target='_self' class='"
								+ selected + "'><img" + " src='" + cls.icon
								+ "' title='" + cls.name + "' /><h2>"
								+ cls.name + "</h2></a></li>");
			}
		},
		createLeftNavbar : function() {
			var display = "";
			for ( var op in DATA.menu) {
				var leftMenuId = "leftmenu_" + (parseInt(op) + 1);
				if (op > 0)
					display = "none";
				$("#leftFrame").append(
						"<dl id='" + leftMenuId
								+ "' class='leftmenu' style='display:"
								+ display + "'>");
				for ( var i = 0; i < treeMenus.length; i++) {
					var pmenu = treeMenus[i];
					if (pmenu.classfiyId != DATA.menu[op].code)
						continue;
					$("#" + leftMenuId).append(
							"<dd><div class='title'><span><img src='"
									+ pmenu.icon + "' /></span>" + pmenu.name
									+ "</div><ul class='menuson' id='menuson"
									+ i + "'>");
					var cmenus = pmenu.menus;
					for ( var j = 0; j < cmenus.length; j++) {
						var active = "";
						$("#menuson" + i + "")
								.append(
										"<li class='"
												+ active
												+ "' parentpos="
												+ pmenu.name
												+ " currentpos="
												+ cmenus[j].name
												+ "><cite></cite><a target='rigFrame' href='"
												+ cmenus[j].url + "'>"
												+ cmenus[j].name
												+ "</a><i></i></li>");
					}
					$(".leftmenu").append("</ul></dd>");
				}
				$("#leftFrame").append("</dl>");
			}

		},
		bindEvent : function() {
			// top导航切换
			$(".nav li a").click(function() {
				me.changeTab($(this));
			});
			// 左树一级导航切换
			$(".title").live("click", function() {
				var $ul = $(this).next('ul');
				$('dd').find('ul').slideUp();
				if ($ul.is(':visible')) {
					$ul.slideUp();
				} else {
					$ul.slideDown();
				}
			});
			// 左树二级导航切换
			$(".menuson li").live("click", function() {
				$(".menuson li.active").removeClass("active");
				$(this).addClass("active");
				$("#parentpos")[0].innerText = $(this).attr("parentpos");
				$("#currentpos")[0].innerText = $(this).attr("currentpos");
			});
		},
		changeTab : function(thisObj) {
			if (thisObj != undefined) {
				var nav = $(".nav li a.selected");
				nav.removeClass("selected");
				thisObj.addClass("selected");
				var tabId = thisObj.attr('tabId');
				$(".leftmenu").hide();
				$("#leftmenu_" + tabId).show();
				me.initOwn();
			} else {

			}
		}
	}
}();