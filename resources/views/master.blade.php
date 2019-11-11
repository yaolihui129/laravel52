<!DOCTYPE html >
<html>
	<head>
		<title>UpCAT</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
		<meta name="_token" content="{{ csrf_token() }}" charset="utf-8" />
		<link href="{{url('/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('/css/animate.min.css')}}" rel="stylesheet" type="text/css" />
		<!-- jquery-1.8.2.min.js -->
		<script type="text/javascript" src="{{url('/javascript/jquery/jquery-1.8.2.min.js')}}"></script>
		<script type="text/javascript" src="{{url('/javascript/jquery/jquery-ui-1.8.24.custom.min.js')}}"></script>
			<script type="text/javascript" src="{{url('/javascript/jquery/jquery.pagination.min.js')}}"></script>
	</head>
	<body class="fixed-sidebar full-height-layout pace-done fixed-nav">
		@yield('mastercontent')
	</body>
	<script src="{{url('javascript/bootstrap/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{url('/javascript/plugins/layer/layer.js')}}"></script>
	<script type="text/javascript" src="{{url('/javascript/common.js')}}"></script>
	<script type="text/javascript" src="{{url('/javascript/validate.js')}}"></script>
	<script>
		$(function () {
			var url=window.location.href;
			if(url==="{{url('/desktop/app_scheme')}}"){
				$("#side-menu4 > a").click();
				$("#side-menu4_1_0 > a").click();
				$("#script").trigger("click");
			}else if(url==="{{url('/desktop/app_job')}}"){
				$("#side-menu4 > a").click();
				$("#side-menu4_1_1 > a").click();
				$("#script").trigger("click");
			}else if(url==="{{url('/desktop/app_report')}}"){
				$("#side-menu1 > a").click();
				$("#side-menu1_1_0 > a").click();
				$("#script").trigger("click");
			}else if(url==="{{url('/desktop/auto_scheme')}}"){
				$("#side-menu3 > a").click();
				$("#side-menu3_1_0 > a").click();
				$("#side-menu3_1_2_1 > a").click();
				$("#script").trigger("click");
			}else if(url==="{{url('/desktop/auto_job')}}"){
				$("#side-menu3 > a").click();
				$("#side-menu3_1_0 > a").click();
				$("#side-menu3_1_2_2 > a").click();
				$("#script").trigger("click");
			}else if(url==="{{url('/desktop/auto_report')}}"){
				$("#side-menu1 > a").click();
				$("#side-menu1_1_0 > a").click();
				$("#script").trigger("click");
			}
		})
	</script>
</html>