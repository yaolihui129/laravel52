<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>YonSuite质量全景分析</title>
    <script type="text/javascript" src="{{url('ys/case05/js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{url('ys/case05/css/comon0.css')}}">
    <link rel="stylesheet" href="{{url('ys/case05/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{url('ys/case05/liMarquee/css/liMarquee.css')}}">
    <link rel="stylesheet" href="{{url('ys/case05/css/jquery-ui.min.css')}}"/>
    <link href="{{url('ys/case05/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css')}}"/>
    <link href="{{url('ys/case05/css/site.css" rel="stylesheet" type="text/css')}}"/>
</head>
<script>
    $(window).load(function () {
        $(".loading").fadeOut()
    });
    /****/
    $(document).ready(function () {
        let whei = $(window).width();
        $("html").css({fontSize: whei / 20});
        $(window).resize(function () {
            let whei = $(window).width();
            $("html").css({fontSize: whei / 20})
        });
    });
</script>
<script type="text/javascript" src="{{url('ys/case05/js/echarts.min.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/js.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/bootstrap.min.js')}}"></script>
<script src="{{url('ys/case05/liMarquee/js/jquery.liMarquee.js')}}"></script>
<script src="{{url('ys/case05/js/echarts-liquidfill.js')}}"></script>
<script src="{{url('ys/case05/js/jquery.bootstrap.newsbox.min.js')}}"></script>
<script src="{{url('ys/case05/js/jquery-ui.min.js')}}"></script>
<body>
<div class="canvas" style="opacity: .2">
    <iframe frameborder="0" src="{{url('ys/case05/js/index.html')}}" style="width: 100%; height: 100%">

    </iframe>
</div>
<div class="loading">
    <div class="loadbox"><img src="{{url('ys/case05/picture/loading.gif')}}">
        页面加载中...
    </div>
</div>
<div class="head">
    {{--<h1>YonSuite质量全景分析05</h1>--}}
    {{--时间显示--}}
    <div class="weather">
        <span id="showTime"></span>
    </div>

    {{--版本号--}}
    <div style="padding-top: 5%;padding-left: 3%">
        <p>
            <span style="color:whitesmoke">版本号:</span>
            <select id="version" style="height:18px;width:150px" class="head_list">
                <option value="3">U8Cloud3.0 V1.0</option>
            </select>
        </p>

    </div>

    {{--集成号--}}
    <div style="padding-left: 17%;margin-top: -2.3%">
        <p >
            <span style="color:whitesmoke">集成号:</span>
            <select id="integrate" style="height:18px;width:150px" class="head_list">
                <option value="0">请选择</option>
            </select>
        </p>
    </div>

    {{--开始时间、结束时间--}}
    <div style="height: 20px;padding-left: 66%;margin-top: -2%">
        <p>
            <span style="color:whitesmoke">开始时间:</span>
            <input  class="head_list" type="text" id="startTime" name="startTime" size="15" style="height:18px">
        </p>
        <p style="padding-left: 40%;margin-top: -6%">
            <span style="color:whitesmoke" >结束时间:</span>
            <input class="head_list" type="text" id="endTime" name="endTime" size="15" style="height:18px">
        </p>
    </div>

    {{--查询按钮--}}
    <div style="padding-left: 94%;margin-top: -2.5%;">
        <button id="search" class="btn btn-info">查询</button>
    </div>

    <script>
        let t = setTimeout(time, 1000);//開始运行
        function time() {
            clearTimeout(t);//清除定时器
            let dt = new Date();
            let y = dt.getFullYear();
            let mt = dt.getMonth() + 1;
            let day = dt.getDate();
            let h = dt.getHours();//获取时
            let m = dt.getMinutes();//获取分
            let s = dt.getSeconds();//获取秒
            document.getElementById("showTime").innerHTML = y + "年" + mt + "月" + day + "-" + h + "时" + m + "分" + s + "秒";
            t = setTimeout(time, 1000); //设定定时器，循环运行
        }
    </script>


</div>
<div class="mainbox">
    <ul class="clearfix">
        {{--第一列报表--}}
        <li>
            {{--1.专项完成度--}}
            <div class="boxall" style="height: 3.2rem">
                <div class="alltitle" style="margin-left: -38%;font-size: 18px;opacity: 0.1">.</div>
                <div class="allnav">
                    <div class="dowebok_left " style="margin-left: 30%">
                        <ul id="pmdLeft_data">
                            <li>
                                <a href="#">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7" id="pmdLeft_data1">
                                            <div style="color: #8BC0EE">专项名称</div>
                                            <div style="color:#FDD71E;font-size: 15px">[专项时间]</div>
                                        </div>
                                        <div class="col-xs-3" id="pmdLeft_data2">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">进度</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><br></li>
                            <li>
                                <a href="#">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7" id="pmdLeft_data1">
                                            <div style="color: #8BC0EE">专项名称</div>
                                            <div style="color:#FDD71E;font-size: 15px">[专项时间]</div>
                                        </div>
                                        <div class="col-xs-3" id="pmdLeft_data2">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">进度</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><br></li>
                            <li>
                                <a href="#">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7" id="pmdLeft_data1">
                                            <div style="color: #8BC0EE">专项名称</div>
                                            <div style="color:#FDD71E;font-size: 15px">[专项时间]</div>
                                        </div>
                                        <div class="col-xs-3" id="pmdLeft_data2">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">进度</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><br></li>
                            <li>
                                <a href="#">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7" id="pmdLeft_data1">
                                            <div style="color: #8BC0EE">专项名称</div>
                                            <div style="color:#FDD71E;font-size: 15px">[专项时间]</div>
                                        </div>
                                        <div class="col-xs-3" id="pmdLeft_data2">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">进度</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><br></li>
                        </ul>
                    </div>
                </div>
                <h5 class="title-2" style="" id="story">故事点进度排行</h5>
                <div class="boxfoot"></div>
            </div>
            {{--2.故事点进度排行--}}
            <div class="boxall" style="height: 3.2rem">
                <div class="alltitle">.</div>
                <div class="allnav" id="echart2" style="margin-top: -33%;height: 130%;width: 105%"></div>
                <div class="boxfoot"></div>
            </div>
            {{--3.业务流程接口执行分析--}}
            <div class="boxall" style="height: 3.2rem">
                <h5 class="title1-3" >业务流程接口执行分析</h5>
                <div style="height:100%; width: 100%;">
                    <div class="sy fx" id="fb1" >
                        <div id="charts1-3" class="panel panel-default" >
                            <div class="panel-body">
                                <div class="row fx-1">
                                    <div>{{--<div class="col-xs-12">--}}
                                        <ul id="left_ul" class="demo_left" style="height: 100%;overflow-y: visible">
                                            <li class="news-item">
                                                <a href="#">
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                        </div>
                                                        <div class="col-xs-7 text-overflow">
                                                            <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="news-item">
                                                <a href="http://www.baidu.com">
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="news-item">
                                                <a href="http://www.baidu.com">
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="news-item">
                                                <a href="http://www.baidu.com">
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="news-item">
                                                <a href="http://www.baidu.com">
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="news-item">
                                                <a href="http://www.baidu.com">
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="news-item">
                                                <a href="http://www.baidu.com">
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="panel-footer"></div>--}}
                        </div>
                    </div>
                    {{--<div class="sy" id="fb2"></div>--}}
                    {{--<div class="sy" id="fb3"></div>--}}

                </div>
                <div class="boxfoot">

                </div>
            </div>
        </li>
        {{--第二列报表--}}
        <li>

            <div class="map text-center">
                {{--1.星光背景旋转--}}
                <div class="map1 text-center"><img src="{{url('ys/case05/picture/lbx.png')}}"></div>
                {{--1.星球背景旋转--}}
                <div class="map2 text-center"><img src="{{url('ys/case05/picture/jt.png')}}"></div>
                <div></div>
                {{--1.整体分析--}}
                <div class="boxall" style="height:3.2rem">
                    <div class="row" style="margin-top: 15%">
                        <div class="col-xs-3" style="padding-left: 12%;padding-top: 4%">
                            <div id="allDone" style="color: #FED51B;font-size: 50px;">339</div>
                            <div style="color: #DAE926;font-size: 15px">已完成</div>
                        </div>
                        <div class="col-xs-6" >
                            <div id="allSum" style="color: #FB1A5A;font-size: 60px">355</div>
                            <div style="color: #B5CD34;font-size: 22px">整体完成情况</div>
                        </div>
                        <div class="col-xs-3" style="padding-right: 12%;padding-top: 4%">
                            <div id="allDoing" style="color: #26FD7B;font-size: 50px ">16</div>
                            <div style="color: #D1E32B;font-size: 15px">未完成</div>
                        </div>
                    </div>
                </div>
                {{--2.倒计时及读条--}}
                <div class="boxall" style="height: 3.2rem">
                    <div id="edition" style="color: whitesmoke;font-size: 20px;margin-top: -8%">倒计时：16.3天</div>
                    <div class="row">
                        <div class="col-xs-3 water" id="water_develop"></div>
                        <div class="col-xs-3 water" id="water_test"></div>
                        <div class="col-xs-3 water" id="water_user"></div>
                        <div class="col-xs-3 water" id="water_editions"></div>
                    </div>
                </div>
                {{--3.UI、接口脚本数量统计--}}
                <div class="boxall" style="height: 3.2rem">
                    <div class="row" style="margin-top: -10%;font-size: 20px">
                        <div class="col-xs-3" >
                            <div style="color: #DEEC24;">压力:</div>
                            <div style="color: #21FCFD;font-size: 20px;margin-right: -100%">
                                发现:<span id="pressureFind" style="color: #21FCFD;">87</span>
                            </div>
                            <div style="color: #21FCFD;font-size: 20px;margin-right: -100%">
                                解决:<span id="pressureResolve" style="color: #21FCFD;">62</span>
                            </div>
                        </div>
                        <div class="col-xs-6" >
                            <div style="color: #25D23B;margin-left: -30%">静态代码:</div>
                            <div style="color: #21FCFD;font-size: 20px;margin-right: -40%">
                                发现:<span id="staticFind" style="color: #21FCFD;">289</span>
                            </div>
                            <div style="color: #21FCFD;font-size: 20px;margin-right: -40%">
                                解决:<span id="staticResolved" style="color: #21FCFD;">90</span>
                            </div>
                        </div>
                        <div class="col-xs-3" >
                            <div style="color: #DEEC24;margin-left: -70%">安全性:</div>
                            <div style="color: #21FCFD;font-size: 20px;margin-left: -50%">
                                发现:<span id="safetyFind" style="color: #21FCFD;">566</span>
                            </div>
                            <div style="color: #21FCFD;font-size: 20px;margin-left: -50%">
                                解决:<span id="safetyResolved" style="color: #21FCFD;">122</span>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 3%">
                        <div class="col-xs-6" >
                            <div style="color: #DEEC24;font-size: 20px;">
                                <span style="color: #DEEC24;margin-left: -15%">接口:</span>
                                <span style="color: #DEEC24;">
                                    <span id="apiSum" style="color: #21FCFD">1217</span>个脚本
                                </span>
                            </div>
                            <div class="col-xs-6">
                                <div style="color: #21FCFD;font-size: 20px;">
                                    发现:
                                    <span id="apiFind" style="color: #DEEC24">24</span></div>
                                <div id="apidate1" style="color: #21FCFD;font-size: 20px">[07-13]</div>
                            </div>
                            <div class="col-xs-6">
                                <div style="color: #21FCFD;font-size: 20px;">解决:
                                    <span id="apiResolved" style="color: #DEEC24">24</span></div>
                                <div id="apidate2" style="color: #21FCFD;font-size: 20px">[07-13]</div>
                            </div>


                        </div>
                        <div class="col-xs-6" >
                            <div style="color: #DEEC24;font-size: 20px;">
                                <span style="color: #DEEC24;margin-left: -15%">UI:</span>
                                <span style="color: #DEEC24;">
                                    <span id="uiSum" style="color: #21FCFD">1217</span>个脚本
                                </span>
                            </div>
                            <div class="col-xs-6">
                                <div style="color: #21FCFD;font-size: 20px;">
                                    发现:
                                    <span id="uiFind" style="color: #DEEC24">24</span></div>
                                <div id="uiDate1" style="color: #21FCFD;font-size: 20px">[07-13]</div>
                            </div>
                            <div class="col-xs-6">
                                <div style="color: #21FCFD;font-size: 20px;">
                                    解决:
                                    <span id="uiResolved" style="color: #DEEC24">242</span></div>
                                <div id="uiDate2" style="color: #21FCFD;font-size: 20px">[07-13]</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </li>
        {{--第三列报表--}}
        <li>
            {{--1.客户验证完成度--}}
            <div class="boxall" style="height:3.2rem">
                <div class="alltitle" style="margin-left: -30%;font-size: 18px;opacity: 0.1">.</div>
                <div class="allnav">
                    <div class="dowebok_right " style="margin-left: 30%">
                        <ul id="pmdRight_data">
                            <li>
                                <a href="http://www.baidu.com">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7 text-overflow">
                                            <div style="color: #8BC0EE">客户验证1</div>
                                            <div style="color:#FDD71E;font-size: 15px">[2019-10-01]</div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">89.00%</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><br></li>
                            <li>
                                <a href="http://www.baidu.com">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7 text-overflow">
                                            <div style="color: #8BC0EE">客户验证2</div>
                                            <div style="color:#FDD71E;font-size: 15px">[2019-10-01]</div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">89.00%</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><br></li>
                            <li>
                                <a href="http://www.baidu.com">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7 text-overflow">
                                            <div style="color: #8BC0EE">客户验证3</div>
                                            <div style="color:#FDD71E;font-size: 15px">[2019-10-01]</div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">89.00%</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><br></li>
                            <li>
                                <a href="http://www.baidu.com">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7 text-overflow">
                                            <div style="color: #8BC0EE">客户验证4</div>
                                            <div style="color:#FDD71E;font-size: 15px">[2019-10-01]</div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">89.00%</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><br></li>
                            <li>
                                <a href="http://www.baidu.com">
                                    <div class="row">
                                        <div class="col-xs-2 pmd">
                                            <img style="margin-left: 100%"  src="{{url('ys/case05/images/left.png')}}">
                                        </div>
                                        <div class="col-xs-7 text-overflow">
                                            <div style="color: #8BC0EE">客户验证5</div>
                                            <div style="color:#FDD71E;font-size: 15px">[2019-10-01]</div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div>.</div>
                                            <div style="color:#FDD71E;font-size: 15px">89.00%</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <h5 class="title-2" style="">缺陷BUG分析</h5>
                {{--<div style="margin-top: -45%;height: 20px">--}}
                    {{--<p>--}}
                        {{--<span style="color:whitesmoke">开始时间:</span>--}}
                        {{--<input  class="head_list" type="text" id="startTime" name="startTime" size="15" style="height:18px">--}}
                    {{--</p>--}}
                    {{--<p style="float: right;margin-top: -7.5%">--}}
                        {{--<span style="color:whitesmoke" >结束时间:</span>--}}
                        {{--<input class="head_list" type="text" id="endTime" name="endTime" size="15" style="height:18px">--}}
                    {{--</p>--}}
                {{--</div>--}}
                <div class="boxfoot"></div>
            </div>
            {{--2.缺陷BUG分析--}}
            <div class="boxall" style="height: 3.2rem">
                <div class="alltitle">.</div>
                <div class="allnav" id="echart5" style="margin-top: -25%;height: 120%"></div>
                <div class="boxfoot"></div>
            </div>
            {{--3.公共项目测试分析--}}
            <div class="boxall" style="height: 3.2rem">
                {{--<div class="alltitle">公共项目测试分析</div>--}}
                {{--<div class="allnav" id="echart6"></div>--}}
                <h5 class="title1-3" >公共项目测试分析</h5>
                <div style="height:100%; width: 100%;">
                    <div class="sy fx" id="echart6" >
                        <div id="charts3-3" class="panel panel-default" >
                            <div class="panel-body">
                                <div class="row fx-1">
                                    <div >{{--<div class="col-xs-12">--}}
                                        <ul id="right_ul" class="demo_right" style="height: 100%;overflow-y: visible">
                                                <li class="news-item">
                                                    <a href="http://www.baidu.com">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                            </div>
                                                            <div class="col-xs-7 text-overflow">
                                                                <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="news-item">
                                                    <a href="http://www.baidu.com">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                            </div>
                                                            <div class="col-xs-7 text-overflow">
                                                                <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="news-item">
                                                    <a href="http://www.baidu.com">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                            </div>
                                                            <div class="col-xs-7 text-overflow">
                                                                <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="news-item">
                                                    <a href="http://www.baidu.com">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                            </div>
                                                            <div class="col-xs-7 text-overflow">
                                                                <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="news-item">
                                                    <a href="http://www.baidu.com">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                            </div>
                                                            <div class="col-xs-7 text-overflow">
                                                                <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="news-item">
                                                    <a href="http://www.baidu.com">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                            </div>
                                                            <div class="col-xs-7 text-overflow">
                                                                <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="news-item">
                                                    <a href="http://www.baidu.com">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <img style="margin-left: 10%"  src="{{url('ys/case05/images/left3.png')}}">
                                                            </div>
                                                            <div class="col-xs-7 text-overflow">
                                                                <div style="font-size: 20px;color: #20E1DD">NO.1北辰股东1</div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div style="font-size: 20px;color: #F1EE74">89.00%</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="panel-footer"></div>--}}
                        </div>
                    </div>
                    {{--<div class="sy" id="fb2"></div>--}}
                    {{--<div class="sy" id="fb3"></div>--}}

                </div>
                <div class="boxfoot"></div>
            </div>
        </li>
    </ul>
</div>
{{--<div class="back"></div>--}}

</body>
<script type="text/javascript" src="{{url('ys/js/common.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/pmd_left.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/story.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/newsList_left.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/all.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/water.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/api.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/pmd_right.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/bug.js')}}"></script>
<script type="text/javascript" src="{{url('ys/case05/js/service/newsList_right.js')}}"></script>
</html>
