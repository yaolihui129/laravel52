@extends('app') @section('content')
<link href="{{url('/css/base.css')}}" rel="stylesheet">
<link href="{{url('/css/login.css')}}" rel="stylesheet">
<script type="text/javascript"
	src="{{url('/javascript/service/reset.js')}}"></script>
<div class="container-fluid">
	<div class="container">
		<div class="wrapper clearfix">
			<div class="userCenter clearfix bg-white">
				<div class="forget-con  clearfix ">
					<div id="resetInfo" class="form m-t-40 step-1">
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
						<input type="button" id="reset"
							class="btn btn-primary block full-width m-b button m-t-100"
							value="修改密码">
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
$(function(){
	$("#reset").on("click",function(){
		ResetUtil.postRegister();
	});
	$("#sendCheckCode").on("click",function(){
		ResetUtil.sendCheckCode();
	});
})
</script>
@endsection