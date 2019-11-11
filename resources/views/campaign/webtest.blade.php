
@extends('campaign.app') @section('content')
		<!-- time-line ================================================== -->
		<div id="myCarousel" class="carousel slide time-line-box" data-ride="carousel">
			<!-- Indicators -->
			<div class="carousel-inner" role="listbox">
				<div class="item active time-line" id="navHeight">

					<div class="container nav-wrap" id="nav-wrap">
						<dl>
							<a href="#section1">
								<dt>
									<img src="{{url('/images/campaign/icon1.png')}}" alt="UPCAT云监控"/>
									<span></span>
								</dt>
								<dd>
									<p class="title">UPCAT云监控</p>
									<p>网站监测、实时预警，让您随时掌握您的系统运行状态。</p>
									<span class="line top"></span>
									<span class="line bottom"></span>
									<span class="line left"></span>
									<span class="line right"></span>
								</dd>
							</a>
						</dl>
						<dl>
							<a href="#section2">
								<dt><img src="{{url('/images/campaign/icon2.png')}}" alt="自动化测试"/><span></span></dt>
								<dd>
									<p class="title">
										自动化测试
									</p>
									<p>快速回归，为快速发布提供支撑；解放人力，降低成本；操作日志、截图结合，一目了然，快速定位问题，降低复现成本；</p>
									<span class="line top"></span>
									<span class="line bottom"></span>
									<span class="line right"></span>
									<span class="line left"></span>
								</dd>
							</a>
						</dl>
						<dl>
							<a href="#section3">
								<dt><img src="{{url('/images/campaign/icon3.png')}}" alt="性能测试"/><span></span></dt>
								<dd>
									<p class="title">性能测试</p>
									<p>提供详尽的性能实时数据，助您分析定位问题，破除性能桎梏。</p>

									<span class="line top"></span>
									<span class="line bottom"></span>
									<span class="line right"></span>
									<span class="line left"></span>
								</dd>
							</a>
						</dl>
						<dl>
							<a href="#section4">
								<dt><img src="{{url('/images/campaign/icon4.png')}}" alt="稳定性测试"/><span></span></dt>
								<dd>
									<p class="title">稳定性测试</p>
									<p>提供对系统功能高频率地随机运行、高频次的压力等各种破坏性操作测试，确保您的系统的稳定性。</p>
									<span class="line top"></span>
									<span class="line bottom"></span>
									<span class="line right"></span>
									<span class="line left"></span>
								</dd>
							</a>
						</dl>
						<dl>
							<a href="#section5">
								<dt><img src="{{url('/images/campaign/icon5.png')}}" alt="安全性测试"/><span></span></dt>
								<dd>
									<p class="title">安全性测试</p>
									<p>提供对系统进行全面的安全性扫描测试，为您的系统安全保驾护航。</p>
									<span class="line top"></span>
									<span class="line bottom"></span>
									<span class="line right"></span>
									<span class="line left"></span>
								</dd>
							</a>
						</dl>

						<a href="{{url('/desktop')}}" class="btn center-block btn-test">立即体验
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
		<div class="subNav">
			<div class="container">
				<a href="#section1" class="active">UPCAT云监控</a>
				<a href="#section2">自动化测试</a>
				<a href="#section3">性能测试</a>
				<a href="#section4">稳定性测试</a>
				<a href="#section5">安全性测试</a>
			</div>
		</div>
		
		
		
		
		<section id="section1">
			<div class="container web-test">
				<h1>UPCAT云监控</h1>
				<div class="row m-100">
					<div class="col-md-6">
					<div class="text-box">
						<h2>网站监测</h2>
						<p>提供7*24小时全天候的监控，确保网站正常运行。</p>
						<button class="btn btn-line">
							立即监测
							<span class="top lt1"></span><span class="top lt2"></span>
							<span class="right lr1"></span><span class="right lr2"></span>
							<span class="bottom lb1"></span><span class="bottom lb2"></span>
							<span class="left ll1"></span><span class="left ll2"></span>
						</button>
					</div>
				</div>
				<div class="col-md-6">
					<img src="{{url('/images/campaign/web-img-1.png')}}"  class="img-box "/>
				</div>
				</div>
				
				<div class="row m-100">
					<div class="col-md-6">
					<img src="{{url('/images/campaign/web-img-2.png')}}"  class="img-box "/>
				</div>

				<div class="col-md-6">
					<div class="text-box ">
						<h2>智能预警</h2>
						<p>提供短信、邮件等预警信息，随时随地掌握网站状态。</p>
						<button class="btn btn-line">立即查看
							<span class="top lt1"></span><span class="top lt2"></span>
							<span class="right lr1"></span><span class="right lr2"></span>
							<span class="bottom lb1"></span><span class="bottom lb2"></span>
							<span class="left ll1"></span><span class="left ll2"></span>
						</button>
					</div>
				</div>
				</div>
				
			</div>
		</section>
		<section id="section2">
			<div class="container web-test">
				<h1>自动化测试</h1>

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
						<button class="btn btn-line btn-block" >立即定制
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
				<h1>性能测试</h1>
				
				
				
				

				<div class="col-md-7">
					<div class="text-box img-bg  property-person" >
						<h2>人工性能测试</h2>
						<p>提供支撑手工测试性能所需要的系统</p>
						<button class="btn btn-line">立即使用
							<span class="top lt1"></span><span class="top lt2"></span>
							<span class="right lr1"></span><span class="right lr2"></span>
							<span class="bottom lb1"></span><span class="bottom lb2"></span>
							<span class="left ll1"></span><span class="left ll2"></span>
						</button>
					</div>
				</div>
				<div class="col-md-5 p-0">
					<div class="text-box img-bg property-auto" >
						<h2>自动化性能测试</h2>
						<p>通过自动化脚本进行性能测试</p>
						<button class="btn btn-line">立即使用
							<span class="top lt1"></span><span class="top lt2"></span>
							<span class="right lr1"></span><span class="right lr2"></span>
							<span class="bottom lb1"></span><span class="bottom lb2"></span>
							<span class="left ll1"></span><span class="left ll2"></span>
						</button>
					</div>
				</div>

			</div>
		</section>
		<section id="section4">
			<div class="container web-test">
				<h1>稳定性测试</h1>

				<div class="col-md-12">
					
					<div class="text-box">
						<!--<h2 class="text-center">人工性能测试</h2>-->
						<p class="text-center">提供对系统功能高频率地随机运行、高频次的压力等各种破坏性操作测试。</p>
						<button class="btn btn-line center-block">立即使用
							<span class="top lt1"></span><span class="top lt2"></span>
							<span class="right lr1"></span><span class="right lr2"></span>
							<span class="bottom lb1"></span><span class="bottom lb2"></span>
							<span class="left ll1"></span><span class="left ll2"></span>
						</button>
					</div>
					<img src="{{url('/images/campaign/web-img-9.png')}}" class="img-box m-t-100"/>
				</div>
				
			</div>
		</section>

		<section id="section5">
			<div class="container web-test">
				<h1>安全性测试</h1>

				<div class="row m-100">
					<div class="text-box col-md-6">
						<h2>静态代码扫描</h2>
						<p>根据定义的代码规则，对源码进行校验，确保代码的安全性。</p>
						<button class="btn btn-line">立即扫描
							<span class="top lt1"></span><span class="top lt2"></span>
							<span class="right lr1"></span><span class="right lr2"></span>
							<span class="bottom lb1"></span><span class="bottom lb2"></span>
							<span class="left ll1"></span><span class="left ll2"></span>
						</button>
					</div>
					<div class="col-md-6 img-box">
						<img src="{{url('/images/campaign/web-img-10.png')}}" />
					</div>
				</div>
				<div class="row m-100">
					<div class="col-md-6 img-box">
						<img src="{{url('/images/campaign/web-img-11.png')}}" />
					</div>
					<div class="text-box col-md-6">
						<h2 >安全性扫描</h2>
						<p>支持Sql注入、Xss跨站脚本、网页挂马、上传漏洞、缓冲区溢出、源代码泄露、数据库泄露、弱口令、管理地址泄露等扫描，确保网站的安全性。</p>
						<button class="btn btn-line">立即检测
							<span class="top lt1"></span><span class="top lt2"></span>
							<span class="right lr1"></span><span class="right lr2"></span>
							<span class="bottom lb1"></span><span class="bottom lb2"></span>
							<span class="left ll1"></span><span class="left ll2"></span>
						</button>
					</div>

					

				</div>

			</div>
		</section>
		<script>


            $("#scheme").on("click",function () {
                location.href="{{url('/desktop/auto_scheme')}}";
            });
            $("#job").on("click",function () {
                location.href="{{url('/desktop/auto_job')}}";
            });
            $("#report").on("click",function () {
                location.href="{{url('/desktop/auto_report')}}";
            });

		</script>


		<script src="{{url('/javascript/campaign/nav.js')}}" type="text/javascript" charset="utf-8"></script>
		<script src="{{url('/javascript/campaign/main.js')}}" type="text/javascript" charset="utf-8"></script>
@endsection