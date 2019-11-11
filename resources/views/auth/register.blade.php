<!DOCTYPE html>
<html lang="en">
<head>
<meta name="_token" content="{{ csrf_token() }}" charset="utf-8" />
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>UpCAT- 注册</title>
<link href="{{url('/css/bootstrap/bootstrap.min.css')}}"
	rel="stylesheet">
<link href="{{url('/css/base.css')}}" rel="stylesheet">
<link href="{{url('/css/login.css')}}" rel="stylesheet">
<script type="text/javascript"
	src="{{url('/javascript/jquery/jquery-1.8.2.min.js')}}"></script>
<script type="text/javascript"
	src="{{url('/javascript/plugins/layer/layer.js')}}"></script>
<script type="text/javascript" src="{{url('/javascript/common.js')}}"></script>
<script type="text/javascript" src="{{url('/javascript/validate.js')}}"></script>
<script type="text/javascript"
	src="{{url('/javascript/service/register.js')}}"></script>
</head>
<body class="gray-bg">
	<div class="container">
		<div class="wrapper clearfix">
			<div class="userCenter clearfix bg-white">
				<div class="forget-con  clearfix ">
					<div id="regstep" class="form m-t-40 step-1">
						<dl>
							<dt>邮箱</dt>
							<dd>
								<input type="text" id="email" placeholder="请输入邮箱"
									validate="required;[email]" val-name="邮箱" class="input">
							</dd>
						</dl>
						<dl>
							<dt>验证码</dt>
							<dd>
								<input type="text" id="checkCode" validate="required"
									val-name="验证码" class="input short-input "><a id="sendCheckCode"
									class="security-btn">验证码</a>
							</dd>
						</dl>
						<dl>
							<dt>密码</dt>
							<dd>
								<input type="password" id="password" placeholder="密码长度6-12"
									validate="required;len[6:12]" val-name="密码" class="input">
							</dd>
						</dl>
						<dl>
							<dt>确认密码</dt>
							<dd>
								<input type="password" id="repeatpwd" placeholder="请重新确认密码"
									val-name="重新确认密码" validate="repeat[password]" val-name="重新确认密码"
									class="input">
							</dd>
						</dl>
						<dl>
							<dt>企业名称</dt>
							<dd>
								<input type="text" id="company" placeholder="请输入企业名称"
									validate="required;len[1:50]" val-name="企业名称" class="input">
							</dd>
						</dl>
						<dl>
							<dt>手机</dt>
							<dd>
								<input type="text" id="tel" placeholder="请输入手机"
									validate="required;[tel]" val-name="手机" class="input">
							</dd>
						</dl>
						<input type="button" id="register"
							class="btn btn-primary block full-width m-b button m-t-100"
							value="注册">
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
$(function(){
	$("#register").on("click",function(){
		RegisterUtil.postRegister();
	});
	$("#sendCheckCode").on("click",function(){
		RegisterUtil.sendCheckCode();
	});
})
</script>
</html>