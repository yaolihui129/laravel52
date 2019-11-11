CommonUtil = function(util) {
	return util = {
		clone : function(obj) {
			let o;
			if (typeof obj == "object") {
				if (obj === null) {
					o = null;
				} else {
					if (obj instanceof Array) {
						o = [];
						for ( let i = 0, len = obj.length; i < len; i++) {
							o.push(util.clone(obj[i]));
						}
					} else {
						o = {};
						for (let j in obj) {
							o[j] = util.clone(obj[j]);
						}
					}
				}
			} else {
				o = obj;
			}
			return o;
		},
		// 获得框架根路径
		getRootPath : function() {
			let strFullPath = window.document.location.href;
			let strPath = window.document.location.pathname;
			let pos = strFullPath.indexOf(strPath);
			let prePath = strFullPath.substring(0, pos);
			let postPath = strPath.substring(0,
				strPath.substr(1).indexOf('/') + 1);
			return (prePath + postPath);
		},
		getRequest : function() {
			let url = location.search; // 获取url中"?"符后的字串
			let request = {};
			if (url.indexOf("?") == -1) {
				let str = url.substr(1);
				let strs = str.split("&");
				for (let i = 0; i < strs.length; i++) {
					request[strs[i].split("=")[0]] = decodeURI(strs[i]
							.split("=")[1]);
				}
			}
			return request;
		},
		// 在当前窗体跳转
		redirect : function(route) {
			window.location.href = util.getRootPath() + route;
		},
		// 打开新窗口
		openWindow : function(route) {
			window.open(util.getRootPath() + route);
		},
		getVerCodeUrl : function() {
			let timestamp = Date.parse(new Date());
			return util.getRootPath() + "/verify/image?acid=" + timestamp;
		},
		// json字符串转为json对象
		parseToJson : function(str) {
			try {
				if (str == "")
					return {
						"success" : 1
					};
				let obj = eval('(' + str + ')');
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
			let headers;
			if (url != null && url != "" && typeof (url) != "undefined") {
				url = util.getRootPath() + url;
				data = (data == null || typeof (data) == "undefined") ? ""
					: data;
				async = (async == null || typeof (async) == "undefined") ? "true"
					: async;// 默认true
				type = (type == null || typeof (type) == "undefined") ? "get"
					: type;// 默认get
				headers = (type == "get" ? "" : {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				});
				$.ajax({
					type: type,
					async: async,
					data: data,
					url: url,
					dataType: "text",
					headers: headers,
					success: function (ret) {
						let retjson = util.parseToJson(ret);
						successfn(retjson);
					},
					error: function (ex) {
						let retjson = {
							"success": 0,
							"error": '网络传输错误'+ex
						};
						errorfn(retjson);
					}
				});
			}
		}
	};
}();
