@extends('layouts.master')
@section('title', 'Đăng nhập')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng nhập</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{!! route('getIndex') !!}">Trang chủ</a> / <span>Đăng nhập</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<form action="{!! route('postLogin') !!}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Đăng nhập</h4> 
					<div style="padding-left: 60%;">
			            <a href="{{ url('login/facebook') }}" id="btn-fbsignup" class="btn btn-primary"></i> Đăng nhập bằng facebook</a>
			        </div> 
					<div class="space20">&nbsp;</div>

					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" id="email" name="txtEmail" required>
					</div>
					<div class="form-block">
						<label for="phone">Password*</label>
						<input type="password" id="phone" name="txtPassword" style="border: 1px solid #e1e1e1;height: 37px;" required>
					</div>
					<div class="form-block" style="padding-left: 50%;">
						<button type="submit" class="btn btn-primary">Đăng nhập</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
		
	</div> <!-- #content -->

</div> <!-- .container -->
@endsection