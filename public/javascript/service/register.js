RegisterUtil = function(util) {
	var codeTimer;
	return util = {
		setCCSending : function() {
			$("#sendCheckCode").attr("disabled", "disabled");// 不可用
			$("#sendCheckCode").html("发送中...");
		},
		setVerCode : function() {
			$("#verify").attr("src", CommonUtil.getVerCodeUrl());
		},
		setCCDisabled : function(timeMark) {
			$("#sendCheckCode").attr("disabled", "disabled");// 不可用
			$("#sendCheckCode").html(timeMark + "秒获取");
		},
		removeCCDisabled : function() {
			clearInterval(codeTimer);
			$("#sendCheckCode").removeAttr("disabled");// 移除不可用属性
			$("#sendCheckCode").html("验证码");
		},
		codeTimer : function(timeMark) {
			codeTimer = setInterval(function() {
				if (timeMark < 0) {
					util.removeCCDisabled();
					return true;
				}
				util.setCCDisabled(timeMark);
				timeMark--;
			}, 1000);
		},
		sendCheckCode : function() {
			var account = $("#email").val();
			var noValidates = new Array("checkCode");
			var error = ValidateUtil.validate("regstep", noValidates);
			if (!error) {
				data = {
					"receiver" : account
				};
				util.setCCSending();
				CommonUtil.requestService('/auth/sendcheckcode', data, true,
						"post", function(data) {// 验证码已发送出去
							if (data.success) {
								var timeMark = 120;
								util.codeTimer(timeMark);// 计时开始服务器发送验证码
							} else {
								util.removeCCDisabled();
								layer.msg(data.error);
							}
						}, function(ex) {// 网络异常
							util.removeCCDisabled();
							layer.msg(ex.error);
						});
			}
		},
		valiStep : function() {
			var error = ValidateUtil.validate("regstep");
			if (!error) {
				var email = $("#email").val();
				var password = $("#password").val();
				var checkcode = $("#checkCode").val();
				var company = $("#company").val();
				var tel = $("#tel").val();
				return data = {
					"email" : email,
					"password" : password,
					"checkcode" : checkcode,
					"company" : company,
					"tel" : tel
				};
				return data;
			}
		},
		postRegister : function() {
			var data = util.valiStep();
			if (data) {
				CommonUtil.requestService('/auth/register', data, false,
						"post", function(data) {
							if (data.success)
								CommonUtil.redirect(data.url);
							else {
								layer.msg(data.error, {
									offset : "50px"
								});
							}
						}, function(ex) {
							layer.msg(ex.error);
						});
			}
		}
	};
}();
