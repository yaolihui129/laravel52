<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UP CAT官网</title>
    <link href="{{url('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('css/campaign/carousel.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('css/campaign/common.css')}}"/>
    <script src="{{url('/javascript/jquery/jquery-2.1.1.min.js')}}"></script>
    <script src="{{url('/javascript/bootstrap/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/javascript/common.js')}}"></script>
    <script type="text/javascript"
            src="{{url('/javascript/plugins/layer/layer.js')}}"></script>
    {{--<script src="{{url('/javascript/campaign/main.js')}}" type="text/javascript" charset="utf-8"></script>--}}
    <script src="{{url('/javascript/campaign/count.js')}}"></script>
</head>

<body>
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><img src="{{url('images/campaign/logo.png')}}"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav  navbar-right col-md-3">
                @if(empty($login))
                    <li>
                        <a href="javascript:void(0);" id="btnLogin">登录</a>
                    </li>
                    <li>
                        <a href="{{url('/auth/register')}}" target="_blank">注册</a>
                    </li>
                @else
                    <li>
                        <a href="{{url('/desktop')}}" target="_blank">我的控制台</a>
                    </li>
                    <li class="my-control">
                        <a href="{{url('/auth/logout')}}">退出</a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right  col-md-5">
                <li class="active">
                    <a href="{{url('')}}">首页</a>
                </li>
                <li id="webtest">
                    <a href="{{url('/camp/webtest')}}">Web产品测试</a>
                </li>
                <li id="apptest">
                    <a href="{{url('/camp/apptest')}}">App测试</a>
                </li>
				<li id="ys">
				    <a href="{{url('/camp/ys/ysIndex')}}" target="_blank">YS专区</a>
				</li>
                @if(!empty($login))
                    <li id="u8">
                        <a href="{{url('/camp/u8')}}" target="_blank">U8专区</a>
                    </li>
                    
                @endif
            </ul>
        </div>
    </div>
</nav>
@yield('content')
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{url('/images/campaign/footer-logo.png')}}"/>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <p class="title">服务</p>
                        <p>
                            <a href="#">服务认证</a>
                        </p>
                        <p>
                            <a href="#">在线客服</a>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="title">伙伴</p>
                        <p>
                            <a href="#">伙伴体系</a>
                        </p>
                        <p>
                            <a href="#">合作联盟</a>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="title">公司</p>
                        <p>
                            <a href="#">关于我们</a>
                        </p>
                        <p>
                            <a href="#">新闻资讯</a>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="title">关注我们</p>
                        <img src="{{url('/images/campaign/code.png')}}"/>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    var start = location.href.lastIndexOf("/") + 1;
    var dhId = location.href.substr(start);
    if ($("#" + dhId).length > 0) {
        $("#" + dhId).siblings().removeClass("active");
        $("#" + dhId).addClass("active");
    }
    $("#btnLogin").on("click", function () {
        layer.open({
            type: 2,
            title: "登录",
            skin: '', // 加上边框
            area: ["400px", "400px"], // 宽高
            scrollbar: false,
            maxmin: false,
            content: CommonUtil.getRootPath() + "/auth/login"
        });
    });
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 600) {
            $(".value").numberRock({
                speed: 40,
                count: 100
            });
            $(".value2").numberRock({
                speed: 30,
                count: 500
            });
            $(".value3").numberRock({
                speed: 20,
                count: 5000
            })
        }
    })


</script>
</body>

</html>
