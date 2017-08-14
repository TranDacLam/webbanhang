@extends('layouts.master')
@section('title', 'Loại sản phẩm')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Sản phẩm {!! $cate_product['name'] !!}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{!! route('getIndex') !!}">Trang chủ</a> / <span>{!! $cate_product['name'] !!}</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<ul class="aside-menu">
						@foreach($cate as $ct)
							<li><a href="{!! url('loai-san-pham/'.$ct['id'].'/'.$ct['alias']) !!}">{{$ct->name}}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4>Sản phẩm mới</h4>
						<div class="beta-products-details">
							<p class="pull-left">Tìm thấy {{count($new_product)}} sản phẩm</p>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach($new_product as $np)
							<div class="col-sm-4">
								<div class="single-item">
									@if($np['promotion_price'] != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div>
										</div>
									@endif
									<div class="single-item-header">
										<a href="{!! url('chi-tiet-san-pham/'.$np['id'].'/'.$np['alias']) !!}"><img src="source//image/product/{!! $np['image'] !!}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$np->name}}</p>
										<p class="single-item-price">
											@if($np['promotion_price'] == 0)
												<span class="flash-sale" >{!! number_format($np['unit_price']) !!} vnđ</span>
											@else
												<span class="flash-del" style="font-size: 15px;">{!! number_format($np['unit_price']) !!} vnđ</span>
												<span class="flash-sale">{!! number_format($np['promotion_price']) !!} vnđ</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="#" data-product-id="{{ $np['id'] }}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{!! url('chi-tiet-san-pham/'.$np['id'].'/'.$np['alias']) !!}">Chi tiết <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="row text-center">{{$new_product->links()}}</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Sản phẩm khác</h4>
						<div class="beta-products-details">
							<p class="pull-left">Tìm thấy {{count($promotion_product)}} sản phẩm</p>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach($promotion_product as $pp)
							<div class="col-sm-4">
								<div class="single-item">
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									<div class="single-item-header">
										<a href="{!! url('chi-tiet-san-pham/'.$pp['id'].'/'.$pp['alias']) !!}"><img src="source/image/product/{{$pp->image}}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$pp->name}}</p>
										<p class="single-item-price">
											<span class="flash-del" style="font-size: 15px;">{!! number_format($pp['unit_price']) !!} vnđ</span>
											<span class="flash-sale">{!!  number_format($pp['promotion_price']) !!} vnđ</span>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="#" data-product-id="{{ $pp['id'] }}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{!! url('chi-tiet-san-pham/'.$pp['id'].'/'.$pp['alias']) !!}">Chi tiết <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="row text-center">{{$promotion_product->links()}}</div>
						<div class="space40">&nbsp;</div>
						
					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection