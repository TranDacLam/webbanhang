@extends('layouts.master')
@section('title', 'Trang chủ')
@section('content')
<div class="fullwidthbanner-container">
	<div class="fullwidthbanner">
		<div class="bannercontainer" >
		    <div class="banner" >
				<ul>
					@foreach($slide as $sl)
					<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
			            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
							<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="{!! asset('source/image/slide/'.$sl['image']) !!}" data-src="{!! asset('source/image/slide/'.$sl['image']) !!}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('{!! asset('source/image/slide/'.$sl['image']) !!}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
							</div>
						</div>
			        </li>
			        @endforeach
				</ul>
			</div>
		</div>
		<div class="tp-bannertimer"></div>
	</div>
</div>
				<!--slider-->
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="beta-products-list">
						<h4>Sản phẩm tìm kiếm</h4>
						<div class="beta-products-details">
							<p class="pull-left">Tìm thấy {{count($product)}} sản phẩm</p>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach($product as $np)
							<div class="col-sm-3">
								<div class="single-item">
									@if($np['promotion_price'] != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div>
										</div>
									@endif
									<div class="single-item-header">
										<a href="{!! url('chi-tiet-san-pham/'.$np['id'].'/'.$np['alias']) !!}"><img src="source/image/product/{{$np->image}}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{!! $np['name'] !!}</p>
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
						<div class="row text-center">{{$product->links()}}</div>
					</div> <!-- .beta-products-list -->
					<div class="space50">&nbsp;</div>
				</div>
			</div> <!-- end section with sidebar and main content -->
		</div> <!-- .main-content -->
	</div> <!-- #content -->
@endsection