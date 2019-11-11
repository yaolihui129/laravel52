/*******************************************************************************
 * add by zhangfj 2014-9-12 框架js窗体统一调用方法
 ******************************************************************************/

// 获得框架根路径
function getRootPath() {
	var strFullPath = window.document.location.href;
	var strPath = window.document.location.pathname;
	var pos = strFullPath.indexOf(strPath);
	var prePath = strFullPath.substring(0, pos);
	var postPath = strPath.substring(0, strPath.substr(1).indexOf('/') + 1);
	return (prePath + postPath+"/public");
}

// 动态在head中添加样式文件
function IncludeLinkStyle(href) {
	var link = document.createElement("link");
	link.rel = "stylesheet";
	link.type = "text/css";
	link.id = "trendsStyle";
	link.href = href;
	$("[id='trendsStyle']").remove();// 将动态添加的样式清空
	document.getElementsByTagName("head")[0].appendChild(link);
}

// 根据指定的Url参数 返回指定的参数值 调用方式：getUrlArgs(url,"参数名"));
function getUrlArgs(url, name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = url.substr(1).match(reg);
	if (r != null)
		return unescape(r[2]);
	return null;
}

// 获取Url参数 返回指定的参数值 调用方式：GetQueryString("参数名"));
function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null)
		return unescape(r[2]);
	return null;
}

// 获取Url参数 返回参数数组 调用方式：var Request = new Object();Request =
// GetRequest();Request['参数1'];
function getRequest() {
	var url = location.search; // 获取url中"?"符后的字串
	var request = {};
	if (url.indexOf("?") == -1) {
		var str = url.substr(1);
		strs = str.split("&");
		for ( var i = 0; i < strs.length; i++) {
			request[strs[i].split("=")[0]] = decodeURI(strs[i].split("=")[1]);
		}
	}
	return request;
}

// 获取一个相对浏览器合适的宽度
function getWidth(width) {
	if (width == undefined || width == "")
		width = $(window).width() - 240; // 浏览器宽-240
	return width;
}

// 获取一个相对浏览器合适的高度
function getHeight(height) {
	if (height == undefined || height == "")
		height = $(window).height() - 120; // 浏览器高- 120
	return height;
}

// 获取一个相对浏览器合适的高度
function getTitle(title) {
	if (title == undefined || title == "")
		title = "自定义窗体";
	return title;
}

// 获取窗体是否可最大化
function getMax(max) {
	if (typeof (max) == "boolean")
		max = max;
	else
		max = true; // 默认窗体可最大化
	return max;
}

// 获取窗体是否可最小化
function getMin(min) {
	if (typeof (min) == "boolean")
		min = min;
	else
		min = true; // 默认窗体可最大化
	return min;
}

// 获取URL及URL参数
function getUrl(url, args) {
	var urlArgs;
	if (Object.prototype.toString.call(args) == "[object Array]") {
		for (arg in args)
			urlArgs += args + ",";
	} else
		urlArgs = args;
	if (url.indexOf("?") != -1)
		url += "&urlArgs=" + urlArgs + "&pageID=" + id;
	else
		url += "?urlArgs=" + urlArgs + "&pageID=" + id;
	return url;
}

// 获取表单状态
function getFormState(formState) {
	if (formState != undefined && formState != "")
		formState = formState;
	else
		formState = 0; // 默认表单状态
	return formState;
}

// 动态调用用户自定义的函数
// TrendsUserFn 关闭时自定义方法名称 backArgs 自定义方法参数（自定义方法中需要解析）
function TrendsUserFn(trendUserFn, trendUserArgs) {
	if (trendUserFn != undefined && trendUserFn != "") { // 窗体弹出时函数
		trendUserFn = eval(trendUserFn);// 将方法名称转为方法对象
		if (trendUserArgs != undefined && trendUserArgs != "") // 带参数的窗体弹出时函数
			trendUserFn(trendUserArgs);
		else
			// 不带参数的窗体弹出时函数
			trendUserFn();
	}
}

// #region 窗体弹出方法汇总
/** *******TrendsUserFn\TrendsUserFn自定义方法必须在父级页面（即调用弹出方法的页面）********** */

// #region 用户自定义连接的弹出窗体 包括非模态窗体和模态窗体
// 用户自定义连接地址（如http://www.baidu.com/、http://localhost:19403/TemplatesPages/TemplatesLogin/DefaultLogin.html）
// 非模态窗体
// url 页面详细地址 title 窗体标题 width 窗体宽度 height 窗体高度 max 窗体是否可最大化（默认为true） min
// 窗体是否可最小化（默认为true） args 参数
// TrendsUserFn 界面弹出时自定义方法名称 initArgs 自定义方法参数 TrendsUserFn关闭窗体回调函数方法名 fnArgs
// 回调函数参数
function Sys_OpenPage(url, title, width, height, max, min, args, trendInitFn,
		initArgs, trendCallFn, backArgs) {
	if (typeof (arguments[0]) == "object") {
		id = arguments[0][1];
		url = getUrl(arguments[0][0], args);
	} else {
		id = title + url;
		url = getUrl(url, args)// 获取URL及URL参数
	}
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	try {
		parent.art.dialog.open(url, {
			"id" : id, // 设定对话框唯一标识 1.防止重复弹出
						// 2.定义id后可以使用art.dialog.list[youID]获取扩展方法
			title : title,
			width : width,
			height : height,
			drag : true,// 是否允许拖拽
			resize : true,// 是否允许更改大小
			esc : true, // 窗体失焦后 支持[ESC]键退出窗体
			max : max, // 允许最大化
			min : min,// 允许最小化
			init : function() {// 窗体弹出时 执行函数
				TrendsUserFn(trendInitFn, initArgs);
			},
			close : function() { // 关闭界面时 回调函数
				TrendsUserFn(trendCallFn, backArgs);
				id = getUrlArgs(url, "pageID");
				if (id.indexOf("/") == -1) {
					Windows.closeMinTask(id);
					$("#sonfile_a" + id).remove();
					$("#folder").hide();
				}
			}
		});
	} catch (e) {

	}
}

// 用户自定义连接地址（如http://www.baidu.com/、http://localhost:19403/TemplatesPages/TemplatesLogin/DefaultLogin.html）
// 模态窗体
// url 页面详细地址 title 窗体标题 width 窗体宽度 height 窗体高度 max 窗体是否可最大化（默认为true） min
// 窗体是否可最小化（默认为true） args 参数
// TrendsUserFn 界面弹出时自定义方法名称 initArgs 自定义方法参数 TrendsUserFn关闭窗体回调函数方法名 fnArgs
// 回调函数参数
function Sys_OpenModePage(url, title, width, height, max, min, args,
		trendInitFn, initArgs, trendCallFn, backArgs) {
	id = arguments[0].length > 1 ? arguments[0][1] : title + url;
	if (typeof (arguments[0]) == "object") {
		id = arguments[0][1];
		url = getUrl(arguments[0][0], args);
	} else {
		id = title + url;
		url = getUrl(url, args);// 获取URL及URL参数
	}
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	try {
		parent.art.dialog.open(url, {
			"id" : id, // 设定对话框唯一标识 1.防止重复弹出
						// 2.定义id后可以使用art.dialog.list[youID]获取扩展方法
			title : title,
			width : width,
			height : height,
			esc : true, // 窗体失焦后 支持[ESC]键退出窗体
			drag : true,// 是否允许拖拽
			resize : true,// 是否允许更改大小
			max : max, // 允许最大化
			min : min,// 允许最小化
			lock : true,// 锁屏 模态窗体 IE8+
			background : '#000', // 模态遮罩层
			opacity : 0.7, // 透明度
			init : function() {// 窗体弹出时 执行函数
				TrendsUserFn(trendInitFn, initArgs);
			},
			close : function() { // 关闭界面时 回调函数
				TrendsUserFn(trendCallFn, backArgs);
				id = getUrlArgs(url, "pageID");
				if (id.indexOf("/") == -1) {
					Windows.closeMinTask(id);
					$("#sonfile_a" + id).remove();
					$("#folder").hide();
				}
			}
		});
	} catch (e) {

	}
}

// #endregion

// #region 用户拼装的html字符串弹出窗体 包括非模态窗体和模态窗体
// 用户拼装的html字符串 非模态窗体
// html 页面详细地址 title 窗体标题 width 窗体宽度 height 窗体高度 max 窗体是否可最大化（默认为true） min
// 窗体是否可最小化（默认为true） args 参数
// TrendsUserFn 界面弹出时自定义方法名称 initArgs 自定义方法参数 TrendsUserFn关闭窗体回调函数方法名 fnArgs
// 回调函数参数
function Sys_OpenDialog(html, title, width, height, max, min, args,
		trendInitFn, initArgs, trendCallFn, backArgs) {
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	id = title;
	// if (typeof (html) == "object")
	// $(html).append("<a id=\"htmlPageID\" pageID=\"" + id + "\"
	// style=\"display:none;\"></a>");
	// else
	$(html).append(
			"<a id=\"htmlPageID\" pageID=\"" + id
					+ "\" style=\"display:none;\"></a>");
	parent.art.dialog({
		id : id,
		title : title,
		width : width,
		height : height,
		content : html,
		max : max, // 允许最大化
		min : min,// 允许最小化
		init : function() {// 窗体弹出时 执行函数
			TrendsUserFn(trendInitFn, initArgs);
		},
		close : function() { // 关闭界面时 回调函数
			TrendsUserFn(trendCallFn, backArgs);
			// id = getUrlArgs(url, "pageID");
			// if (id.indexOf("/") == -1) {
			// Windows.closeMinTask(id);
			// $("#sonfile_a" + id).remove();
			// $("#folder").hide();
			// }
		}
	});
}
// 用户拼装的html字符串 模态窗体
// html 页面详细地址 title 窗体标题 width 窗体宽度 height 窗体高度 max 窗体是否可最大化（默认为true） min
// 窗体是否可最小化（默认为true） args 参数
// TrendsUserFn 界面弹出时自定义方法名称 initArgs 自定义方法参数 TrendsUserFn关闭窗体回调函数方法名 fnArgs
// 回调函数参数
function Sys_OpenModeDialog(html, title, width, height, max, min, args,
		trendInitFn, initArgs, trendCallFn, backArgs) {
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	id = title;
	// if (typeof (html) == "object")
	// $(html).append("<a id=\"htmlPageID\" pageID=\"" + id + "\"
	// style=\"display:none;\"></a>");
	// else
	$(html).append(
			"<a id=\"htmlPageID\" pageID=\"" + id
					+ "\" style=\"display:none;\"></a>");
	parent.art.dialog({
		id : id,
		title : title,
		width : width,
		height : height,
		content : html,
		max : max, // 允许最大化
		min : min,// 允许最小化
		lock : true,// 锁屏 模态窗体 IE8+
		background : '#000', // 模态遮罩层
		opacity : 0.7, // 透明度
		init : function() {// 窗体弹出时 执行函数
			TrendsUserFn(trendInitFn, initArgs);
		},
		close : function() { // 关闭界面时 回调函数
			TrendsUserFn(trendCallFn, backArgs);
		}
	});
}

// #endregion

// #region 表单运行器弹出方法 包括非模态窗体和模态窗体
// 表单打开方法（不允许更改大小） 非模态窗体
// formID 表单ID formState 表单状态 title 表单标题 width 窗体宽度 height 窗体高度 max
// 窗体是否可最大化（默认为true） min 窗体是否可最小化（默认为true） args 参数
// TrendsUserFn 界面弹出时自定义方法名称 initArgs 自定义方法参数 TrendsUserFn关闭窗体回调函数方法名 fnArgs
// 回调函数参数
function Sys_OpenFormDialog(formID, formState, title, width, height, max, min,
		args, trendInitFn, initArgs, trendCallFn, backArgs) {
	formState = getFormState(formState); // 获取表单状态
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	id = formID;
	url = getRootPath() + "/Run/FormRun/FormRun.html"; // 表单运行界面
	url = getUrl(url) + "&formID=" + formID + "&formState=" + formState; // 获取表单运行
																			// URL
	try {
		// if (art.dialog.open == undefined)

		parent.art.dialog.open(url, {
			"id" : id, // 设定对话框唯一标识 1.防止重复弹出
						// 2.定义id后可以使用art.dialog.list[youID]获取扩展方法
			title : title,
			width : width,
			height : height,
			drag : true,// 是否允许拖拽
			resize : false,// 是否允许更改大小
			esc : true, // 窗体失焦后 支持[ESC]键退出窗体
			max : max, // 允许最大化
			min : min,// 允许最小化
			init : function() {// 窗体弹出时 执行函数
				TrendsUserFn(trendInitFn, initArgs);
			},
			close : function() { // 关闭界面时 回调函数
				TrendsUserFn(trendCallFn, backArgs);
			}
		});
	} catch (e) {

	}

}

// 表单打开方法（不允许更改大小） 模态窗体
// formID 表单ID formState 表单状态 title 表单标题 width 窗体宽度 height 窗体高度 max
// 窗体是否可最大化（默认为true） min 窗体是否可最小化（默认为true） args 参数
// TrendsUserFn 界面弹出时自定义方法名称 initArgs 自定义方法参数 TrendsUserFn关闭窗体回调函数方法名 fnArgs
// 回调函数参数
function Sys_OpenFormModeDialog(formID, formState, title, width, height, max,
		min, args, trendInitFn, initArgs, trendCallFn, backArgs) {
	formState = getFormState(formState); // 获取表单状态
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	id = formID;
	url = getRootPath() + "/Run/FormRun/FormRun.html"; // 表单运行界面
	url = getUrl(url) + "&formID=" + formID + "&formState=" + formState; // 获取表单运行
																			// URL
	try {
		parent.art.dialog.open(url, {
			"id" : id, // 设定对话框唯一标识 1.防止重复弹出
						// 2.定义id后可以使用art.dialog.list[youID]获取扩展方法
			title : title,
			width : width,
			height : height,
			drag : true,// 是否允许拖拽
			resize : false,// 是否允许更改大小
			esc : true, // 窗体失焦后 支持[ESC]键退出窗体
			max : max, // 允许最大化
			min : min,// 允许最小化
			lock : true,// 锁屏 模态窗体 IE8+
			background : '#000', // 模态遮罩层
			opacity : 0.7, // 透明度
			init : function() {// 窗体弹出时 执行函数
				TrendsUserFn(trendInitFn, initArgs);
			},
			close : function() { // 关闭界面时 回调函数
				TrendsUserFn(trendCallFn, backArgs);
			}
		});
	} catch (e) {

	}

}

// #endregion

// #region 列表运行器弹出方法 包括非模态窗体和模态窗体
// 列表打开方法（不允许更改大小） 非模态窗体
// listID 表单ID title 表单标题 width 窗体宽度 height 窗体高度 max 窗体是否可最大化（默认为true） min
// 窗体是否可最小化（默认为true） args 参数
// TrendsUserFn 界面弹出时自定义方法名称 initArgs 自定义方法参数 TrendsUserFn关闭窗体回调函数方法名 fnArgs
// 回调函数参数
function Sys_OpenListDialog(listID, title, width, height, max, min, args,
		trendInitFn, initArgs, trendCallFn, backArgs) {
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	id = arguments[0].length > 1 ? arguments[0][1] : listID;
	url = getRootPath() + "/Run/ListRun/ListRun.html"; // 列表运行界面
	url = getUrl(url) + "&listID=" + id; // 获取列表运行 URL
	try {
		parent.art.dialog.open(url, {
			"id" : id, // 设定对话框唯一标识 1.防止重复弹出
						// 2.定义id后可以使用art.dialog.list[youID]获取扩展方法
			title : title,
			width : width,
			height : height,
			drag : true,// 是否允许拖拽
			resize : false,// 是否允许更改大小
			esc : true, // 窗体失焦后 支持[ESC]键退出窗体
			max : max, // 允许最大化
			min : min,// 允许最小化
			init : function() {// 窗体弹出时 执行函数
				TrendsUserFn(trendInitFn, initArgs);
			},
			close : function() { // 关闭界面时 回调函数
				TrendsUserFn(trendCallFn, backArgs);
				id = getUrlArgs(url, "pageID");
				if (id.indexOf("/") == -1) {
					Windows.closeMinTask(id);
					$("#sonfile_a" + id).remove();
					$("#folder").hide();
				}
			}
		});
	} catch (e) {

	}

}

// 列表打开方法（不允许更改大小） 模态窗体
// listID 表单ID title 表单标题 width 窗体宽度 height 窗体高度 max 窗体是否可最大化（默认为true） min
// 窗体是否可最小化（默认为true） args 参数
// TrendsUserFn 界面弹出时自定义方法名称 initArgs 自定义方法参数 TrendsUserFn关闭窗体回调函数方法名 fnArgs
// 回调函数参数
function Sys_OpenListModeDialog(listID, title, width, height, max, min, args,
		trendInitFn, initArgs, trendCallFn, backArgs) {
	width = getWidth(width); // 获取窗体宽度
	height = getHeight(height);// 获取窗体高度
	title = getTitle(title);// 获取窗体标题
	max = getMax(max);// 获取窗体是否可最大化
	min = getMin(min);// 获取窗体是否可最小化
	id = arguments[0].length > 1 ? arguments[0][1] : listID;
	url = getRootPath() + "/Run/ListRun/ListRun.html"; // 列表运行界面
	url = getUrl(url) + "&listID=" + listID; // 获取列表运行 URL
	try {
		parent.art.dialog.open(url, {
			"id" : id, // 设定对话框唯一标识 1.防止重复弹出
						// 2.定义id后可以使用art.dialog.list[youID]获取扩展方法
			title : title,
			width : width,
			height : height,
			drag : true,// 是否允许拖拽
			resize : false,// 是否允许更改大小
			esc : true, // 窗体失焦后 支持[ESC]键退出窗体
			max : max, // 允许最大化
			min : min,// 允许最小化
			lock : true,// 锁屏 模态窗体 IE8+
			background : '#000', // 模态遮罩层
			opacity : 0.7, // 透明度
			init : function() {// 窗体弹出时 执行函数
				TrendsUserFn(trendInitFn, initArgs);
			},
			close : function() { // 关闭界面时 回调函数
				TrendsUserFn(trendCallFn, backArgs);
				id = getUrlArgs(url, "pageID");
				if (id.indexOf("/") == -1) {
					Windows.closeMinTask(id);
					$("#sonfile_a" + id).remove();
					$("#folder").hide();
				}
			}
		});
	} catch (e) {

	}

}

// #endregion

// #endregion

function CloseWindow(id) { // 关闭指定的窗体
	art.dialog.list[id].close();
}

function CloseCurrentWindow(freshParent) { // 通过父窗体关闭当前窗体
	var id = getQueryString("pageID");
	parent.art.dialog.list[id].close(freshParent);
}

// json字符串转为json对象
function ParseToJson(str) {
	try {
		var obj = eval('(' + str + ')');
	} catch (e) {
		alert(e);
	}
	return obj;
}

function getBrowserInfo() {
	var agent = navigator.userAgent.toLowerCase();
	var regStr_ie = /msie [\d.]+;/gi;
	var regStr_ff = /firefox\/[\d.]+/gi;
	var regStr_chrome = /chrome\/[\d.]+/gi;
	var regStr_saf = /safari\/[\d.]+/gi;
	// IE
	if (agent.indexOf("msie") > 0) {
		return agent.match(regStr_ie);
	}

	// firefox
	if (agent.indexOf("firefox") > 0) {
		return agent.match(regStr_ff);
	}

	// Chrome
	if (agent.indexOf("chrome") > 0) {
		return agent.match(regStr_chrome);
	}

	// Safari
	if (agent.indexOf("safari") > 0 && agent.indexOf("chrome") < 0) {
		return agent.match(regStr_saf);
	}

}
