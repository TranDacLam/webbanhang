@extends('layouts.master')
@section('title', 'Đặt hàng')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Checkout</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{!! route('getIndex') !!}">Trang chủ</a> / <span>Đặt hàng</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<form action="{!! route('postCheckOut') !!}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-sm-6">
					<h4>Thông tin đặt hàng</h4>
					<div class="space20">&nbsp;</div>
					<div class="form-block">
						<label for="name">Họ tên*</label>
						<input type="text" id="name" name="name" placeholder="Họ tên" value="{!! Auth::user()->full_name !!}" required>
					</div>
					<div class="form-block">
						<label>Giới tính</label>
						<input id="gender" type="radio" class="input-radio" name="gender" value="Nam" checked="checked" style="width: 10%"><span style="margin-right: 10%"> Nam</span>
						<input id="gender" type="radio" class="input-radio" name="gender" value="Nữ"  style="width: 10%"><span> Nữ</span>
					</div>
					<div class="form-block">
						<label for="email">Email*</label>
						<input type="email" id="email" name="email" placeholder="example@gmail.com" value="{!! Auth::user()->email !!}" required>
					</div>
					<div class="form-block">
						<label for="adress">Địa chỉ*</label>
						<input type="text" id="address" name="address" placeholde="Địa chỉ" required>
					</div>
					<div class="form-block">
						<label for="phone">Số điện thoại*</label>
						<input type="text" id="phone" name="phone" placeholder="số điện thoại" required>
					</div>						
					<div class="form-block">
						<label for="notes">Ghi chú</label>
						<textarea id="notes" name="notes"></textarea>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="your-order">
						<div class="your-order-head"><h5>Đơn đặt hàng</h5></div>
						<div class="your-order-body">
							<div class="your-order-item">
								<div>
								@if(Session::has('cart'))
								@foreach($product_cart as $cart)
									<!--  one item	 -->
									<div class="media">
										<img width="35%" src="source/image/product/{!! $cart['item']['image'] !!}" alt="" class="pull-left">
										<div class="media-body">
											<p class="font-large">{!! $cart['item']['name'] !!}</p>
											<span class="color-gray your-order-info">Đơn giá: {!! $cart['item']['promotion_price'] == 0 ? number_format($cart['item']['unit_price']) : number_format($cart['item']['promotion_price']) !!} vnđ</span>
											<span class="color-gray your-order-info">Số lượng: {!! $cart['qty'] !!}</span>
										</div>
									</div>
									<!-- end one item -->
								@endforeach
								@endif
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="your-order-item">
								<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
								<div class="pull-right"><h5 class="color-black">{!! number_format(Session('cart')->totalPrice) !!} vnđ</h5></div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
						
						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
									<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block;">
										Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhận viên giao hàng.
									</div>						
								</li>

								<li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
									<label for="payment_method_cheque">Chuyển khoản </label>
									<div class="payment_box payment_method_cheque" style="display: none;">
										Chuyển khoản đến tài khoảng sau: 
										<br>- Số tài khoản: 111111
										<br>- Chủ TK: AAAA
										<br>- Ngan hàng Agribank 
									</div>						
								</li>
							</ul>
						</div>

						<div class="text-center"><button type="submit" class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
					</div> <!-- .your-order -->
				</div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection