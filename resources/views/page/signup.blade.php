@extends('layouts.master')
@section('title', 'Đăng Ký')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng kí</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{!! route('getIndex') !!}">Trang chủ</a> / <span>Đăng kí</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		
		<form action="{!! route('postSignup') !!}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Đăng kí</h4>
					<div class="space20">&nbsp;</div>

					<div class="form-block">
						<label for="your_last_name">Họ tên*</label>
						<input type="text" id="your_last_name" name="txtFullName" required>
					</div>
				
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" id="email" name="txtEmail" required>
					</div>

					<div class="form-block">
						<label for="phone">Password*</label>
						<input type="password" id="phone" name="txtPass" style="border: 1px solid #e1e1e1;
    						height: 37px;" required>
					</div>
					<div class="form-block">
						<label for="phone">Re password*</label>
						<input type="password" id="phone" name="txtRepass" style="border: 1px solid #e1e1e1;
    						height: 37px;" required>
					</div>
					<div class="form-block" style="padding-left: 50%;">
						<button type="submit" class="btn btn-primary">Đăng ký</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection