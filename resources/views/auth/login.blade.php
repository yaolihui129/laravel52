<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="_token" content="{{ csrf_token() }}" charset="utf-8" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>UpCAT- 登录</title>
		<link href="{{url('/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{url('/css/base.css')}}" rel="stylesheet">
		<link href="{{url('/css/login.css')}}" rel="stylesheet">
		<script type="text/javascript" src="{{url('/javascript/jquery/jquery-1.8.2.min.js')}}"></script>
		<script type="text/javascript" src="{{url('/javascript/plugins/layer/layer.js')}}"></script>
		<script type="text/javascript" src="{{url('/javascript/common.js')}}"></script>
		<script type="text/javascript" src="{{url('/javascript/service/login.js')}}"></script>
	</head>
	<body class="">
		<div class="">
			<div class="">
				<div class="login">
					<div class="loginbox">
						<div class="login-form" id="lgform">
							<p>
								<input id="chrEmail" type="text" class="input username"
									placeholder="邮箱" val-name="邮箱">
							</p>
							<p>
								<input id="password" type="password" class="input pwd"
									placeholder="密码" val-name="密码" autocomplete="new-password">
							</p>
							<p>
								<input type="text" id="vercode" val-name="验证码"
									class="input verify-input"><img id="verify" class="verify"
									alt="验证码"
									title="点击更换验证码">
							</p>
							<p class="t-right">
								<a href="{{url('/auth/register')}}">立即注册</a> <a
									href="{{url('/password/email')}}">忘记密码了？</a>
							</p>
							<input type="button" id="login" class="button button-login"
								value="登录">
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		$(function(){
			LoginUtil.init();
		});
	</script>
</html>