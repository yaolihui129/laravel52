CommonUtil = function(util) {
	return util = {
		getRootPath : function() {
			var strFullPath = window.document.location.href;
			var strPath = window.document.location.pathname;
			var pos = strFullPath.indexOf(strPath);
			var prePath = strFullPath.substring(0, pos);
			return prePath;
			/*
			 * var postPath = strPath.substring(0,
			 * strPath.substr(1).indexOf('/') + 1); return (prePath + postPath);
			 */
		},
		getVerCodeUrl : function() {
			var timestamp = Date.parse(new Date());
			return util.getRootPath() + "/verify/image?acid=" + timestamp;
		},
		ajaxLoad : function(contentId, url) {
			$("#" + contentId).load(util.getRootPath() + url);
		},
		getLength : function(jsons) {
			var len = 0;
			for ( var json in jsons) {
				len++;
			}
			return len;
		},
		// 在当前窗体跳转
		redirect : function(route) {
			window.location.href = util.getRootPath() + route;
		},
		// 打开新窗口
		openWindow : function(route) {
			window.open(util.getRootPath() + route);
		},
		broserType : function() {// 浏览器类型
			var agent = navigator.userAgent.toLowerCase();
			return browser = {
				ie : /(msie\s|trident.*rv:)([\w.]+)/.test(agent),
				webkit : (agent.indexOf(' applewebkit/') > -1),
				mac : (agent.indexOf('macintosh') > -1),
				quirks : (document.compatMode == 'BackCompat')
			};
		},
		broserVersion : function() {// 浏览器版本
			var agent = navigator.userAgent.toLowerCase();
			var v1 = agent.match(/(?:msie\s([\w.]+))/);
			var v2 = agent.match(/(?:trident.*rv:([\w.]+))/);
			if (v1 && v2 && v1[1] && v2[1]) {
				version = Math.max(v1[1] * 1, v2[1] * 1);
			} else if (v1 && v1[1]) {
				version = v1[1] * 1;
			} else if (v2 && v2[1]) {
				version = v2[1] * 1;
			} else {
				version = 0;
			}
			return version;
		},
		includeLinkStyle : function() {// 动态在head中添加样式文件
			var link = document.createElement("link");
			link.rel = "stylesheet";
			link.type = "text/css";
			link.id = "trendsStyle";
			link.href = href;
			$("[id='trendsStyle']").remove();// 将动态添加的样式清空
			document.getElementsByTagName("head")[0].appendChild(link);
		},
		autoResizeImage : function(maxWidth, maxHeight, objImg) {// 等比例缩放图片
			var hRatio;
			var wRatio;
			var Ratio = 1;
			var w = objImg.width;
			var h = objImg.height;
			wRatio = maxWidth / w;
			hRatio = maxHeight / h;
			if (maxWidth == 0 && maxHeight == 0) {
				Ratio = 1;
			} else if (maxWidth == 0) {// if (hRatio < 1) Ratio =
				hRatio;
			} else if (maxHeight == 0) {
				if (wRatio < 1)
					Ratio = wRatio;
			} else if (wRatio < 1 || hRatio < 1) {
				Ratio = (wRatio <= hRatio ? wRatio : hRatio);
			}
			if (Ratio < 1) {
				w = w * Ratio;
				h = h * Ratio;
			}
			objImg.height = h;
			objImg.width = w;
		},
		getRequest : function() {// 获取Url参数 返回参数数组 调用方式：var Request = new
			// Object();Request
			// =GetRequest();Request['参数1'];
			var url = location.search; // 获取url中"?"符后的字串
			var request = {};
			if (url.indexOf("?") != -1) {
				var str = url.substr(1);
				strs = str.split("&");
				for ( var i = 0; i < strs.length; i++) {
					request[strs[i].split("=")[0]] = decodeURI(strs[i]
							.split("=")[1]);
				}
			}
			return request;
		},
		DateFormat : function(date, fmt) { // author: meizz
			var o = {
				"M+" : date.getMonth() + 1, // 月份
				"d+" : date.getDate(), // 日
				"h+" : date.getHours(), // 小时
				"m+" : date.getMinutes(), // 分
				"s+" : date.getSeconds(), // 秒
				"q+" : Math.floor((date.getMonth() + 3) / 3), // 季度
				"S" : date.getMilliseconds()
			// 毫秒
			};
			if (/(y+)/.test(fmt))
				fmt = fmt.replace(RegExp.$1, (date.getFullYear() + "")
						.substr(4 - RegExp.$1.length));
			for ( var k in o)
				if (new RegExp("(" + k + ")").test(fmt))
					fmt = fmt.replace(RegExp.$1,
							(RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k])
									.substr(("" + o[k]).length)));
			return fmt;
		},
		// json字符串转为json对象
		parseToJson : function(str) {
			try {
				if (str == "")
					return {
						"success" : 1
					};
				var obj = eval('(' + str + ')');
				return obj;
			} catch (e) {
				return {
					"success" : 0,
					"error" : '获取数据错误'
				};
			}
		},
		// ajax通用请求
		requestService : function(url, data, async, type, successfn, errorfn) {
			if (url != null && url != "" && typeof (url) != "undefined") {
				var req = util.getRequest();
				url = util.getRootPath() + url + "?au="
						+ (req["au"] ? req["au"] : "0");
				data = (data == null || typeof (data) == "undefined") ? ""
						: data;
				async = (async == null || typeof (async) == "undefined") ? "true"
						: async;// 默认true
				type = (type == null || typeof (type) == "undefined") ? "get"
						: type;// 默认get
				headers = (type == "get" ? "" : {
					'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
				});
				if (util.broserType().ie && util.broserVersion() <= 9) {
					var XMLHttpReq = new ActiveXObject("Microsoft.XMLHTTP");// IE低版本创建XMLHTTP
					var params = "";
					for ( var name in data) {
						params += encodeURIComponent(name) + "="
								+ encodeURIComponent(data[name]) + "&";
					}
					if (type == "post") {
						XMLHttpReq.open(type, url, true);
						XMLHttpReq.setRequestHeader("X-CSRF-TOKEN", $(
								'meta[name="_token"]').attr('content'));
						// 设置表单提交时的内容类型
						XMLHttpReq.setRequestHeader("Content-Type",
								"application/x-www-form-urlencoded");
						XMLHttpReq.send(params);
					} else {
						XMLHttpReq.open(type, url + "?" + params, true);
						XMLHttpReq.send(null);
					}
					XMLHttpReq.onreadystatechange = function() {
						if (XMLHttpReq.readyState == 4) {
							if (XMLHttpReq.status == 200) {
								var ret = XMLHttpReq.responseText;
								retjson = util.parseToJson(ret);
								successfn(retjson);
							}
						}
					}; // 指定响应函数
				} else
					$.ajax({
						type : type,
						async : async,
						data : data,
						url : url,
						dataType : "text",
						headers : headers,
						crossDomain : true,
						success : function(ret) {
							retjson = util.parseToJson(ret);
							successfn(retjson);
						},
						error : function(ex) {
							if (ex.status != 0) {
								retjson = {
									"success" : 0,
									"error" : '网络传输错误'
								};
								errorfn(retjson);
							}
						}
					});
			}
		}
	};
}();
