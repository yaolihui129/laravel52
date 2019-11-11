@extends('campaign.app') @section('content')
    <!-- time-line ================================================== -->
    <div id="myCarousel" class="carousel slide time-line-box" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item active app-test" id="navHeight">

                <div class="container nav-wrap " id="nav-wrap">

                    <ul>
                        <span class="line-left"></span>
                        <li>
                            <a href="#section1">
                                <img src="{{url('images/campaign/app-icon1.png')}}" alt="自动化测试"/>
                                <p class="title">自动化测试</p>
                                <p>快速回归，为快速发布提供支撑；解放人力，降低成本；操作日志、截图结合，一目了然，快速定位问题，降低复现成本；</p>

                            </a>
                        </li>
                        <li>
                            <a href="#section2">
                                <img src="{{url('images/campaign/app-icon2.png')}}" alt="稳定性测试"/>
                                <p class="title">稳定性测试</p>
                                <p>提供对系统功能高频率地随机运行、高频次的压力等各种破坏性操作测试，确保您的系统的稳定性。</p>

                            </a>
                        </li>
                        <li>
                            <a href="#section3">
                                <img src="{{url('images/campaign/app-icon3.png')}}" alt="漏洞分析"/>
                                <p class="title">漏洞分析</p>
                                <p>提供APK适配分析和漏洞安全检测，兼容和漏洞问题一次搞定。</p>

                            </a>
                        </li>
                        <li>
                            <a href="#section4">
                                <img src="{{url('images/campaign/app-icon4.png')}}" alt="兼容测试"/>
                                <p class="title">兼容测试</p>
                                <p>支持在常见机型上进行APP安装、启动Monkey、卸载等操作，快速定位闪退、性能问题，提高您的APP的兼容性。</p>

                            </a>
                        </li>
                        <span class="line-right"></span>
                    </ul>
                    <div class="clearfix"></div>

                    <a href="/desktop" class="btn center-block btn-test ">立即体验
                        <span class="top1"></span><span class="top2"></span>
                        <span class="right1"></span><span class="right2"></span>
                        <span class="bottom1"></span><span class="bottom2"></span>
                        <span class="left1"></span><span class="left2"></span>
                    </a>
                </div>
            </div>

        </div>

    </div>
    <!-- /.carousel end -->
    <div class="subNav subNav-app">
        <div class="container">
            <a href="#section1" class="active">自动化测试</a>
            <a href="#section2">稳定性测试</a>
            <a href="#section3">漏洞分析</a>
            <a href="#section4">兼容测试</a>
        </div>
    </div>




    <section id="section1">
        <div class="container web-test">
            <h1>自动化测试</h1>

            <div class="col-md-6">
                <div class="text-box img-bg app-1">
                    <h2>脚本仓库</h2>
                    <p>根据测试项目组织脚本，实现脚本的分门别类，清晰、有序。</p>
                    <button class="btn btn-line">立即上传
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-box img-bg app-2">
                    <h2>案例池</h2>
                    <p>根据测试需求组合脚本，定制个性化测试案例，方便、灵活。</p>
                    <button class="btn btn-line">立即定制
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-box img-bg app-3">
                    <h2>任务清单</h2>
                    <p>根据测试计划组合测试案例，制定测试任务，智能、快捷。</p>
                    <button class="btn btn-line">立即制定
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-box img-bg  app-4">
                    <h2>测试报告</h2>
                    <p>根据任务的执行情况，生成对应的任务报告，清晰、详尽。</p>
                    <button class="btn btn-line">立即查看
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section id="section2">
        <div class="container web-test">
            <h1>稳定性测试</h1>
            <div class="col-md-3">
                <img src="{{url('/images/campaign/web-img-3.png')}}"  class="img-box"/>
                <div class="text-box">
                    <h2 class="text-center">案例池</h2>
                    <p>根据测试需求组合脚本，定制个性化测试案例，方便、灵活</p>
                    <button class="btn btn-line btn-block" id="scheme">立即查看
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>

                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{url('/images/campaign/web-img-4.png')}}" class="img-box"/>
                <div class="text-box">
                    <h2 class="text-center">智能预警</h2>
                    <p>提供短信、邮件等预警信息，随时随地掌握网站状态。</p>
                    <button class="btn btn-line btn-block">立即定制
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{url('/images/campaign/web-img-5.png')}}"  class="img-box"/>
                <div class="text-box">
                    <h2 class="text-center">任务清单</h2>
                    <p>根据测试计划组合测试案例，制定测试任务，智能、快捷</p>
                    <button class="btn btn-line btn-block" id="job">立即制定
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{url('/images/campaign/web-img-6.png')}}"  class="img-box"/>
                <div class="text-box">
                    <h2 class="text-center">测试报告</h2>
                    <p>根据任务的执行情况，生成对应的任务报告，清晰、详尽</p>
                    <button class="btn btn-line btn-block" id="report">立即查看
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>


    <section id="section3">
        <div class="container web-test">
            <h1>漏洞分析</h1>

            <div class="col-md-5 col-md-offset-1">
                <div class="box app-box">
                    <img src="{{url('images/campaign/app-img-6.png')}}"/>
                    <h4>App适配</h4>
                    <p>对App适配问题进行定位，确保产品的正确性</p>
                    <p class="text-right"><a href="#">立即使用</a></p>

                    <span class="line top1"></span><span class="line top2"></span>
                    <span class="line left2"></span><span class="line left3"></span>
                    <span class="line right1"></span><span class="line right2"></span><span class="line right3"></span>
                    <span class="line bottom1"></span><span class="line bottom2"></span>

                </div>
            </div>
            <div class="col-md-5">
                <div class="box app-box">
                    <img src="{{url('images/campaign/app-img-7.png')}}"/>
                    <h4>漏洞分析</h4>
                    <p>对App的漏洞进行分析，定位代码问题，确保产品的安全性。</p>
                    <p class="text-right"><a href="#">立即使用</a></p>

                    <span class="line top1"></span><span class="line top2"></span>
                    <span class="line left1"></span><span class="line left2"></span><span class="line left3"></span>
                    <span class="line right2"></span><span class="line right3"></span>
                    <span class="line bottom1"></span><span class="line bottom2"></span>

                </div>
            </div>

        </div>
    </section>
    <section id="section4">
        <div class="container web-test">
            <h1>兼容测试</h1>

            <div class="col-md-12">

                <div class="text-box">
                    <!--<h2 class="text-center">人工性能测试</h2>-->
                    <p class="text-center">提供各种主流的真机，确保App在各种机型上能够正常安装、启动、卸载。</p>
                    <button class="btn btn-line center-block">立即使用
                        <span class="top lt1"></span><span class="top lt2"></span>
                        <span class="right lr1"></span><span class="right lr2"></span>
                        <span class="bottom lb1"></span><span class="bottom lb2"></span>
                        <span class="left ll1"></span><span class="left ll2"></span>
                    </button>
                </div>
                <img src="{{url('images/campaign/app-img-8.png')}}" class="img-box m-t-100"/>
            </div>

        </div>
    </section>

    <script src="{{url('/javascript/campaign/nav.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{url('/javascript/campaign/main.js')}}" type="text/javascript" charset="utf-8"></script>
     <script>


         $("#scheme").on("click",function () {
             location.href="{{url('/desktop/app_scheme')}}";
         });
         $("#job").on("click",function () {
             location.href="{{url('/desktop/app_job')}}";
         });
         $("#report").on("click",function () {
             location.href="{{url('/desktop/app_report')}}";
         });

     </script>
@endsection