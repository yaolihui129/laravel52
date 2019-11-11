@extends('campaign.app') @section('content')
		<!-- Carousel ========================= -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<div class="container">
					</div>
				</div>
				<div class="item">
					<div class="container">

					</div>
				</div>

			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<!-- /.carousel end -->
		<div class="list-area">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="box">
							<h4>Web产品测试</h4>
							<p>支持对您的网站进行Web自动化测试、Web性能测试、Web稳定性测试、Web安全性测试，全方面的保证您的产品质量!</p>
							<a href="{{url('/camp/webtest')}}">点击了解</a>

							<span class="line top1"></span><span class="line top2"></span>
							<span class="line left1"></span><span class="line left2"></span><span class="line left3"></span>
							<span class="line right1"></span><span class="line right2"></span><span class="line right3"></span>
							<span class="line bottom1"></span><span class="line bottom2"></span>

						</div>
					</div>
					<div class="col-md-4">
						<div class="box">
							<h4>App产品测试</h4>
							<p>支持对您的App产品进行App自动化测试、App稳定性测试、App漏洞分析、App兼容性测试，全方面的保证您的产品质量!</p>
							<a href="{{url('/camp/apptest')}}">点击了解</a>

							<span class="line top1"></span><span class="line top2"></span>
							<span class="line left1"></span><span class="line left2"></span><span class="line left3"></span>
							<span class="line right1"></span><span class="line right2"></span><span class="line right3"></span>
							<span class="line bottom1"></span><span class="line bottom2"></span><span class="line bottom3"></span>

						</div>
					</div>
					<div class="col-md-4">
						<div class="box">
							<h4>众测</h4>
							<p>提供测试任务发布功能，根据任务发布方发布的任务类型精确匹配相应领域的测试
								专家进行测试，保障产品质量，降低测试成本！</p>
							<a href="#">点击了解</a>
							<span class="line top1"></span><span class="line top2"></span>
							<span class="line left1"></span><span class="line left2"></span><span class="line left3"></span>
							<span class="line right1"></span><span class="line right2"></span><span class="line right3"></span>
							<span class="line bottom1"></span><span class="line bottom2"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<section>
			<div class="container">
				<div class="text-box col-md-6">
					<h1>一体化的测试平台</h1>
					<p>平台涵盖了App测试、web测试，让您可以通过本平台实现多领域的测试工作。</p>

					<span class="line line1"></span>
					<span class="line line2"></span>
					<span class="line line3"></span>
					<span class="line line4"></span>
					<span class="line line5"></span>
					<span class="line line6"></span>

				</div>
				<div class="img-box col-md-6">
					<img src="images/campaign/img-1.png" />
				</div>
			</div>
		</section>

		<section class="bg">
			<div class="container">
				<div class="img-box col-md-6">
					<img src="images/campaign/img-2.png" />
				</div>
				<div class="text-box col-md-6">
					<h1>全方位的测试项</h1>
					<p>平台提供了功能自动化测试、安全性测试、性能测试、稳定性测试等测试项，让您可以快速、高效地完成测试任务，保证您的产品质量。</p>

					<span class="line line1"></span>
					<span class="line line2"></span>
					<span class="line line3"></span>
					<span class="line line5"></span>
					<span class="line line4"></span>
					<span class="line line6"></span>

				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="text-box col-md-6">
					<h1>一键操作、方便快捷</h1>
					<p>平台中的测试项通过任务的形式展现，您只需要点击执行相应的测试任务按钮，就可以实现全自动地完成相关测试项。</p>

					<span class="line line1"></span>
					<span class="line line2"></span>
					<span class="line line3"></span>
					<span class="line line4"></span>
					<span class="line line5"></span>
					<span class="line line6"></span>

				</div>
				<div class="img-box col-md-6">
					<img src="images/campaign/img-3.png" />
				</div>
			</div>
		</section>

		<section class="bg">
			<div class="container">
				<div class="img-box col-md-6">
					<img src="images/campaign/img-4.png" />
				</div>
				<div class="text-box col-md-6">
					<h1>报告丰富，快速定位</h1>
					<p>测试任务完成后会产生详细的任务执行报告，图文并茂，让您可以快速地了解测试任务的执行情况，轻松地定位、复现问题。</p>

					<span class="line line1"></span>
					<span class="line line2"></span>
					<span class="line line3"></span>
					<span class="line line4"></span>
					<span class="line line5"></span>
					<span class="line line6"></span>

				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="text-box col-md-6">
					<h1>统一控制，操作简单</h1>
					<p>平台提供了统一的控制台，让您通过控制台即可实现所有的测试操作。</p>

					<span class="line line1"></span>
					<span class="line line2"></span>
					<span class="line line3"></span>
					<span class="line line4"></span>
					<span class="line line5"></span>
					<span class="line line6"></span>

				</div>
				<div class="img-box col-md-6">
					<img src="images/campaign/img-5.png" />
				</div>
			</div>
		</section>
		</div>
		<!-- /section end -->
		<div class="my_value" >
			<span class="last-line"></span>
			<div class="container">
				<h1>我们的价值</h1>
				<div class="row">
					<div class="col-md-4">
						<h2><span class="value"></span>W+</h2>
						<p>累计执行任务数</p>
					</div>
					<div class="col-md-4">
						<h2> <span class="value2"></span>W+</h2>
						<p>累计运行脚本数</p>
					</div>
					<div class="col-md-4">
						<h2><span class="value2"></span>+</h2>
						<p>累计发现问题数</p>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">

		</script>
@endsection
