@extends('campaign.app') @section('content')
    <!-- time-line ================================================== -->
    <div class="container m-100 u8">
        <h3>U8工具箱</h3>
        <div class="row">
            <div class="col-md-6" style="padding-right: 0;">
                <h4>功能测试工具</h4>
                <div class="col-md-6 ">
                    <!--.common-box.bg1-->
                    <a href="/camp/ult" class=" common-box bg1">
                        <img src="{{url('images/campaign/u8-1.png')}}"/>
                        <p>（ULT）升级对数工具</p>
                    </a>
                </div>
                <div class="col-md-6 ">
                    <a href="/camp/mtt" class=" common-box bg2">
                        <img src="{{url('images/campaign/u8-2.png')}}"/>
                        <p>（MTT）多语测试工具</p>
                    </a>
                </div>
                <div class="col-md-12">
                    <a href="/camp/sett" class=" common-box bg3">
                        <img src="{{url('images/campaign/u8-3.png')}}" class="l-80"/>
                        <p>（SETT)软加密测试工具</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/camp/dult" class=" common-box bg4">
                        <img src="{{url('images/campaign/u8-4.png')}}"/>
                        <p>（(DULT)数据卸载对数工具</p>
                    </a>
                </div>
                <div class="col-md-6  ">
                    <a href="/camp/pct" class=" common-box bg1">
                        <img src="{{url('images/campaign/u8-5.png')}}"/>
                        <p>（PCT）权限对比工具</p>
                    </a>
                </div>

                <div class="col-md-12">
                    <a href="/camp/js" class=" common-box bg3">
                        <img src="{{url('images/campaign/u8-12.png')}}" class="l-80"/>
                        <p>（JS)检索工具</p>
                    </a>
                </div>


            </div>
            <div class="col-md-6" style="padding-left: 0;">
                <h4>代码测试工具</h4>
                <div class="col-md-6">
                    <a href="/camp/lsbcx" class=" common-box bg1 height-2">
                        <img src="{{url('images/campaign/u8-6.png')}}"/>
                        <p>（LSBCX）临时表查询工具</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/camp/gdi" class=" common-box bg2">
                        <img src="{{url('images/campaign/u8-7.png')}}"/>
                        <p>（GDI）内存泄露检查</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/camp/sjkjgdb" class=" common-box bg4">
                        <img src="{{url('images/campaign/u8-8.png')}}"/>
                        <p>（SJKJGDB）数据库结构对比工具</p>
                    </a>
                </div>
                <div class="col-md-12">
                    <a href="/camp/wj" class=" common-box bg3">
                        <img src="{{url('images/campaign/u8-10.png')}}" class="l-80"/>
                        <p>（WJ）文件对比工具</p>
                    </a>
                </div>

                <div class="col-md-6 ">
                    <!--.common-box.bg1-->
                    <a href="/camp/xn" class=" common-box bg1">
                        <img src="{{url('images/campaign/u8-11.png')}}"/>
                        <p>（XN）性能测试工具</p>
                    </a>
                </div>

                <div class="col-md-6 ">
                    <a href="/camp/ylzx" class=" common-box bg2">
                        <img src="{{url('images/campaign/u8-3.png')}}"/>
                        <p>（YLZX）用例执行工具</p>
                    </a>
                </div>
            </div>
        </div>


        <h3>U8集成系统</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <a href="http://tiyan.yonyouup.com/" class=" common-box bg2" target="_blank">
                        <img src="{{url('images/campaign/u8-10.png')}}"/>
                        <p>（UEP）体验中心</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="http://10.10.12.142/uds/public" class=" common-box bg3" target="_blank">
                        <img src="{{url('images/campaign/u8-11.png')}}"/>
                        <p>（UDS）U8指标中心</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="http://192.168.210.199/testcase_U8/Logon.aspx" class=" common-box bg4" target="_blank">
                        <img src="{{url('images/campaign/u8-12.png')}}"/>
                        <p>（YL）用例系统</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="http://10.10.12.165:8080" class=" common-box bg1" target="_blank">
                        <img src="{{url('images/campaign/u8-13.png')}}"/>
                        <p>（JIRA）Jira系统</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="http://172.16.50.160/FrameSetWithSilverLight.htm" class=" common-box bg1" target="_blank">
                        <img src="{{url('images/campaign/u8-1.png')}}"/>
                        <p>（CQ）CQ系统</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('/javascript/campaign/nav.')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{url('/javascript/campaign/main.js')}}" type="text/javascript" charset="utf-8"></script>
@endsection