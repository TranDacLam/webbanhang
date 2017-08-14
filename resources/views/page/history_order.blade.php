@extends('layouts.master')
@section('title', 'Lịch sử đặt hàng')
@section('content')
<div class="inner-header">
	<div class="container" style="color: blue;">
		<div class="pull-left">
			<h6 class="inner-title">Lịch sử đặt hàng</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{ route('getIndex') }}">Trang chủ</a> / <span>Lịch sử đặt hàng</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
	<div class="container">
		<div id="content">	
			<div class="table-responsive">
			<div class="panel-footer">
                <a href="{{ route('getProfile') }}" title="Quay lại" data-toggle="tooltip" class="btn btn-sm btn-primary">Quay lại hồ sơ cá nhân</a>
              </div>
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">STT</th>
							<th class="product-price">Tổng tiền</th>
							<th class="product-price">Ngày đặt hàng</th>
							<th class="product-quantity">Thanh toán</th>
							<th class="product-subtotal">Trạng thái</th>
							<th class="product-remove">Xem</th>
						</tr>
					</thead>
					<tbody>
						<?php $stt = 0 ?>
						@foreach($data as $item)
						<?php $stt++ ?>
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									{{ $stt }}
								</div>
							</td>

							<td class="product-price">
								{{ number_format($item['total']) }} vnđ
							</td>

							<td class="product-price">
								{{ $item['date_order'] }}
							</td>

							<td class="product-quantity">
								{{ $item['payment'] }}
							</td>

							<td class="product-subtotal">
								 @if($item['bill']['status'] == 0)
				                    Đang chờ giải quyết
				                @else 
				                    @if($item['bill']['status'] == 1)
				                        Chấp nhận, đang xử lý
				                    @else 
				                        @if($item['bill']['status'] == 2)
				                            Đang giao hàng
				                        @else 
				                            @if($item['bill']['status'] == 3)
				                                Hoàn thành
				                            @else 
				                                Từ chối
				                            @endif
				                        @endif
				                    @endif
				                @endif
							</td>
							<td class="product-remove">
								<a href="{{ route('getDetaiHistoryOrder', $item['id']) }}" class="remove" title="Remove this item" style="color: blue;">Xem chi tiết</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
		</div> 
	</div> 
@endsection