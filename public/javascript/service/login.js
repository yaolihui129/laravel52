LoginUtil = function(me) {
    var codeTimer;
    return me = {
        initOwn: function() {
            $("#login").on('click', function() {
                me.postLogin();
            });
            // 更改验证码
            $("#verify").bind("click", function() {
                me.setVerCode();
            });
            /* 页面注册keydown事件 */
            $(window).keydown(function(e) {
                var curKey = e.which;
                if (curKey == 13) { /* 按enter键登录 */
                    me.postLogin();
                }
            });
            /*alert(1)*/
            me.setVerCode();
        },
        init: function() {
            me.initOwn();
        },
        setVerCode: function() {
            $("#verify").attr("src", CommonUtil.getVerCodeUrl());
        },
        validateLogin: function() {
            var error = ""; // ValidateUtil.validate("lgform");
            if (!error) {
                var email = $("#email").val(); // 去掉左右空字符串
                var pwd = $("#password").val();
                var vercode = $("#vercode").val();
                var remember = "";
                if ($("#remember").attr("checked"))
                    remember = $("#remember").val();
                var data = {
                    "email": email,
                    "password": pwd,
                    "vercode": vercode,
                    "remember": remember
                };
                return data;
            } else {
                util.setVerCode();
                return false;
            }
        },
        postLogin: function() {
            var data = me.validateLogin();
            if (data) {
                CommonUtil.requestService("/auth/login", data, true, "POST",
                    function(data, status) {
                        if (data.success) { // 成功 重新加载列表
                            // alert(data.url);
                            if (self != top)
                            // 若不是在IFrame中 则刷新当前页面
                            // （登录超时时 刷新）
                                parent.location.reload();
                            else
                                CommonUtil.redirect(data.url);
                        } else {
                            layer.msg(data.error);
                            me.setVerCode();
                        }
                    },
                    function(error) {
                        layer.msg(ex.error);
                        me.setVerCode();
                    });
            }
        }
    };
}();