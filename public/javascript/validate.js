ValidateUtil = function(util) {
	return util = {
		validate : function(areaid, noValidates) {
			var errors = "";
			var controller;
			$("#" + areaid + " [validate]")
					.each(
							function() {
								if (errors != ""
										|| (noValidates && noValidates
												.indexOf(this.id) != -1))
									return false;// 相当于break
								controller = $(this);
								var validates = controller.attr("validate");
								var valis = validates.split(";");
								var conval = controller.val();
								var val_name = controller.attr("val-name");
								var error = "";
								for ( var iv = 0; iv < valis.length; iv++) {
									var vali = valis[iv];
									if (vali == "")
										break;
									if (error == "") {
										var index = vali.indexOf("[");
										if (index != -1) {
											if (index == 0) {// 预定义的规则为email|tel
												// 模式
												var vals = vali.substring(1,
														vali.length - 1).split(
														"|");
												var issuccess = false;
												for ( var i = 0; i < vals.length; i++) {
													if (!issuccess) {
														switch (vals[i]) {
														case "email":
															if (util
																	.isEmail(conval))
																issuccess = true;
															break;
														case "tel":
															if (util
																	.isTel(conval))
																issuccess = true;
															break;
														}
													}
												}
												if (!issuccess) {
													error = val_name + "不符合要求";
												}
											} else {
												if (vali.indexOf("len") == 0) {// 长度验证
													var lenlimits = vali
															.substring(
																	index + 1,
																	vali.length - 1)
															.split(":");
													if (!util.conLen(conval,
															lenlimits[0],
															lenlimits[1]))
														error = val_name
																+ "长度不符合要求";
												} else if (vali
														.indexOf("repeat") == 0) {// 字符串重复验证
													var referid = vali
															.substring(
																	index + 1,
																	vali.length - 1);
													var referval = $(
															"#" + referid)
															.val();
													if (!util.check(conval,
															referval))
														error = val_name
																+ "与参照不一致";
												}
											}
										} else {
											switch (vali) {
											case "required":
												if (util.isEmpty(conval))
													error = val_name + "不允许为空";
												break;
											case "checked":
												if (!controller.attr("checked"))
													error = val_name + "必须选中";
												break;
											case "email":
												if (!util.isEmail(conval))
													error = val_name + "不符合要求";
												break;
											case "tel":
												if (!util.isTel(conval))
													error = val_name + "不符合要求";
												break;
											case "number":
												if (!util.isDigit(conval))
													error = val_name + "必须为数字";
												break;
											}
										}
									} else
										break;
								}
								errors = error;
							});
			if (errors) {
				// controller.addClass("validate-controller");
				layer.tips(errors, controller);
				// controller.after("<div class='validate-tip'>1111</div>");
			}
			return errors;
		},
		// 删除字符串二边空格
		trim : function(str) {
			return str.replace(/(^[\s]*)|([\s]*$)/g, "");
		},
		// 删除字符串左边空格
		leftTrim : function(str) {
			return str.replace(/(^[\s]*)/g, "");
		},
		// 删除字符串右边空格
		rightTrim : function(str) {
			return str.replace(/([\s]*$)/g, "");
		},
		// 判断用户输入是否为空
		isEmpty : function(str) {
			str = util.trim(str);
			return (str == null || str == "");
		},
		// 判断是否为邮箱
		isEmail : function(str) {
			var patrn = /^[A-Za-z0-9]+([-_.][A-Za-z0-9]+)*@([A-Za-z0-9]+[-.])+[A-Za-z0-9]{2,5}$/;
			return patrn.test(str);
		},
		// 是否为电话号码
		isTel : function(str) {
			var patrn = /^1[3|4|5|7|8]\d{9}$/;
			return patrn.test(str);
		},
		// 校验是否全是数字
		isDigit : function(str, len) {
			var patrn = /^\d+$/;
			return patrn.test(str);
		},
		// 校验是否是整数
		isInteger : function(str) {
			var patrn = /^[+-]?\d+$/;
			return patrn.test(str);
		},
		// 校验是否是正整数
		isPlusInteger : function(str) {
			var patrn = /^[+]?[1-9]\d*$/;
			return patrn.test(str);
		},
		// 校验是否是负整数
		isMinusInteger : function(str) {
			var patrn = /^-[1-9]\d+$/;
			return patrn.test(str);
		},
		// 校验是否是浮点数
		isFloat : function(str) {
			var patrn = /^[+-]?\d+\.\d+$/;
			return patrn.test(str);
		},
		// 校验是否是正浮点数
		isPlusfloat : function(str) {
			var patrn = /^[+]?\d+\.\d+$/;
			return patrn.test(str);
		},
		// 校验是否是负浮点数
		isMinusFloat : function(str) {
			var patrn = /^-\d+\.\d+$/;
			return patrn.test(str);
		},
		// 校验是否全是英文
		isEnglish : function(str) {
			var patrn = /^[a-zA-Z]+$/;
			return patrn.test(str);
		},
		// 取得用户输入的字符串的长度
		getLength : function(str) {
			var i, sum = 0;
			for (i = 0; i < str.length; i++) {
				if ((str.charCodeAt(i) >= 0) && (str.charCodeAt(i) <= 255))
					sum++;
				else
					sum += 2;
			}
			return sum;
		},

		// 校验字符串：只能输入任意个(至少一个)字母、数字、下划线(常用手校验用户名和密码)
		isString : function(str) {
			var patrn = /^(\w){1,}$/;
			return patrn.test(str);
		},
		// 校验两次输入的密码是否相同
		check : function(pwd, repwd) {
			if (pwd != repwd) {
				return false;
			}
			return true;
		},
		// 限定表单项不能输入的字符
		contain : function(str, charset)// 字符串包含测试函数
		{
			var i;
			for (i = 0; i < charset.length; i++)
				if (str.indexOf(charset.charAt(i)) >= 0)
					return true;
			return false;
		},
		// 限定可以输入的特殊字符("'\/&*%@#$!;?><=+-().,)，返回转译后的字符串
		specialchar : function(str) {
			var newstr = "";
			for ( var i = 0; i < str.length; i++) {
				if (str
						.search(/^[\'\\\/\&\*\%\@\#\$\!\;\?\>\<\=\+\-\(\)\.\,\| \"]+$/) != -1) {
					newstr += "\\";
				}
				newstr += str.charAt(i);

			}
			return newstr;
		},
		// 限制字符串长度
		conLen : function(str, minlen, maxlen) {
			if (maxlen == "" || maxlen == null || typeof (maxlen) == undefined) {
				if (str.length >= minlen) {// 字符串长度最短
					return true;
				}
			} else {
				if (str.length >= minlen && str.length <= maxlen) {
					return true;
				}
			}
			return false;
		},
		// 验证URL地址是否正确
		isUrl : function(str) {
			var patrn = /^((https|http|ftp|rtsp|mms):\/\/)?([a-zA-Z]+:\d+\/)?[\w-]+(\.[\w-]+)+([\w-\.\/?%&=]*)?$/;
			return patrn.test(str);
		},
		// 验证是否为金钱
		isMoney : function(str) {
			if (str.search(/^\d{1,3}(\,\d{3})*(\.\d+)?$/) != -1) {
				return str;
			} else if (str.search(/^(\d+)(\.\d+)?$/) != -1) {

				var sstr = "";
				var wstr = "";
				var m = 0;
				for ( var i = str.length - 1; i >= 0; i--) {
					wstr += str.charAt(i);
					if (str.charAt(i) == ".") {
						m = i - 1;
						break;
					}
				}
				i = 0;
				for (m; m >= 0; m--) {
					sstr += str.charAt(i);
					if (i % 3 == 0 && m != 0) {
						sstr += ",";
					}
					i++;
				}
				for (i = wstr.length - 1; i >= 0; i--) {
					sstr += wstr.charAt(i);
				}
				return sstr;
			}
		},
		isAccord : function(standardStr, str) {
			var standards = standardStr.split(',');
			var strs = str.split(',');
			if (standards.length < strs.length)
				return false;
			else
				return true;
		}
	};
}();