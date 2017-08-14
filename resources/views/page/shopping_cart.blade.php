@extends('layouts.master')
@section('title', 'Giỏ hàng')
@section('content')
<div class="inner-header">
	<div class="container" style="color: blue;">
		<div class="pull-left">
			<h6 class="inner-title">Giỏ hàng</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{ route('getIndex') }}">Trang chủ</a> / <span>Giỏ hàng</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
	<div class="container">
		<div id="content">
			
			<div class="table-responsive">
				<!-- Shop Products Table -->
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name" style="width: 300px;">Sản phẩm</th>
							<th class="product-price">Đơn giá</th>
							<th class="product-price">Giá khuyến mãi</th>
							<th class="product-quantity">Số lượng.</th>
							<th class="product-subtotal">Thành tiền</th>
							<th class="product-remove">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($product_cart as $pc)
						<tr class="cart_item" id="del-cart-{{ $pc['item']['id'] }}">
							<td class="product-name">
								<div class="media">
									<a href="{{ url('chi-tiet-san-pham/'.$pc['item']['id'].'/'.$pc['item']['alias']) }}"><img class="pull-left" src="source/image/product/{!! $pc['item']['image'] !!}" alt="" height="50px;" width="50px;"></a>
									<br>
									<div class="media-body">
										<p class="font-large table-title"><a href="{{ url('chi-tiet-san-pham/'.$pc['item']['id'].'/'.$pc['item']['alias']) }}">{!! $pc['item']['name'] !!}</a></p>
									</div>
								</div>
							</td>

							<td class="product-price">
								{{ number_format($pc['item']['unit_price']) }}
							</td>

							<td class="product-price">
								<span class="amount">
									@if($pc['item']['promotion_price']) 
										{{number_format($pc['item']['promotion_price'])}}
									@else 
										Không có 
									@endif 
								</span>
							</td>

							<td class="product-quantity">
								<input type="number" value="{{$pc['qty']}}" name="quantily" min="1" class="form-control text-center change-qty-cart" data-product-id="{{ $pc['item']['id'] }}" id="qty-cart-{{ $pc['item']['id'] }}" style="width: 90px; font-weight: bold;" />
							</td>
							
							<td class="product-subtotal">
								<span class="amount" id="subTotalCart-{{ $pc['item']['id'] }}">
								@if($pc['item']['promotion_price'] == 0)
								    {{ number_format(subTotal($pc['qty'], $pc['item']['unit_price'])) }}           
								@else
								    {{ number_format(subTotal($pc['qty'], $pc['item']['promotion_price'])) }}
								@endif
								</span>
							</td>

							<td class="product-remove">
								<a href="#" data-product-id="{{ $pc['item']['id'] }}" class="remove remove-cart" title="Remove this item"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6" class="actions">
								<a href="{!! route('getIndex') !!}" class="beta-btn primary text-center"><i class="fa fa-chevron-left"></i>Tiếp tục mua hàng </a> 
								<a href="{!! route('getDelAllCart') !!}" onclick="return confirmDel('Bạn đồng ý xóa không?')" class="beta-btn primary text-center">Xóa giỏ hàng <i class="fa fa-trash-o "></i></a>
								<a href="{!! route('getCheckOut') !!}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
							</td>
						</tr>
						<tr>
							<td colspan="6" class="actions">
								<div class="cart-totals pull-right" style="margin-top: -12%;">
									<div class="cart-totals-row"><h5 class="cart-total-title">Giỏ hàng</h5></div>
									<div class="cart-totals-row"><span>Shipping:</span> <span>Miễn phí</span></div>
									<div class="cart-totals-row"><span>Tổng tiền:</span> 
										<span class="totalPriceCart">{!! number_format(Session('cart')->totalPrice) !!} vnđ</span>
									</div>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="clearfix"></div>
		</div> 
	</div> 
@endsection