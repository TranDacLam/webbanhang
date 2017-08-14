@extends('layouts.master')
@section('title', 'Giới thiệu')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Giới thiệu</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{!! route('getIndex') !!}">Trang chủ</a> / <span>Giới thiệu</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content">
		<div class="our-history">
			<h2 class="text-center wow fadeInDown">Our History</h2>
			<div class="space35">&nbsp;</div>

			<div class="history-slider text-center">
				<div class="history-navigation">
					<a data-slide-index="0" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center">2016</span></a>
					<a data-slide-index="1" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center">2017</span></a>
					<a data-slide-index="2" href="blog_with_2sidebars_type_e.html" class="circle"><span class="auto-center">2018</span></a>
				</div>
				<div class="history-slides">
					<div> 
						<div class="row">
						{{-- <div class="col-sm-5">
							<img src="assets/dest/images/history.jpg" alt="">
						</div> --}}
						<div class="">
							<h5 class="other-title">Sinh viên</h5>
							<p>
								Mõi mòn trên ghế nhà trường =))
							</p>
							<div class="space20">&nbsp;</div>
							<p>Học và học, chơi và chơi, chơi nhưng học</p>
						</div>
						</div> 
					</div>
					<div> 
						<div class="row">
						<div class="">
							<h5 class="other-title">Cuối khóa</h5>
							<p>
								Đồ án tốt nghiệp chạy đua với thời gian
							</p>
							<div class="space20">&nbsp;</div>
							<p>Chỉ một từ BẦM DẬP</p>
						</div>
						</div> 
					</div>
					<div> 
						<div class="row">
						<div class="">
							<h5 class="other-title">Tương lai</h5>
							<p>
								Cố gắng vươn xa
							</p>
							<div class="space20">&nbsp;</div>
							<p>Cày cuốc</p>
						</div>
						</div> 
					</div>
				</div>
			</div>
		</div>

		<div class="space50">&nbsp;</div>
		<hr />
		<div class="space50">&nbsp;</div>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection