<div id="header">
	<div class="header-top">
		<div class="container">
			<div class="pull-left auto-width-left">
				<ul class="top-menu menu-beta l-inline">
					<li><a href=""><i class="fa fa-home"></i> K342/08 Hùng Vương, Thanh Khê, Đà Nẵng</a></li>
					<li><a href=""><i class="fa fa-phone"></i> 0168 879 1267</a></li>
				</ul>
			</div>
			<div class="pull-right auto-width-right">
				<ul class="top-details menu-beta l-inline">
					@if(Auth::check())
					<li><a href="{{ route('getProfile') }}"><i class="fa fa-user"></i> {!! Auth::user()->full_name !!}</a></li>
					<li><a href="{!! route('getLogout') !!}"><i class="fa fa-user"></i> Đăng xuất</a></li>
					@else
					<li><a href="{!! route('getLogin') !!}">Đăng nhập</a></li>
					<li><a href="{!! route('getSignup') !!}">Đăng kí</a></li>
					@endif
				</ul>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-top -->
	<div class="header-body">
		<div class="container beta-relative">
			<div class="pull-left">
				<a href="{{ route('getIndex') }}" id="logo"><img src="source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
			</div>
			<div class="pull-right beta-components space-left ov">
				<div class="space10">&nbsp;</div>
				<div class="beta-comp">
					<form role="search" method="get" id="searchform2" action="{!! route('getSearch') !!}">
				        <input type="text" value="" name="key" data-toggle="modal" data-target="#Search" id="s" placeholder="Nhập từ khóa..." />
				        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
					</form>
				</div>

				<div class="beta-comp">
					<div class="cart">
						<i class="fa fa-shopping-cart"></i>
						<a href="{{ route('getCart') }}"> Giỏ hàng ( <span class="totalQtyCart">{!! Session::has('cart') ? Session('cart')->totalQty : 'Chưa có' !!}</span> sản phẩm) <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-body -->
	<div class="header-bottom" style="background-color: #7b6363;">
		<div class="container" style="text-transform: uppercase; ">
			<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
			<div class="visible-xs clearfix"></div>
			<nav class="main-menu">
				<ul class="l-inline ov">
					<li><a href="{{ route('getIndex') }}">Trang chủ</a></li>
					<li><a href="#">Thể loại</a>
						<ul class="sub-menu">
							@foreach($cate as $item)
							@if($item['parent_id'] == 0)
								<li><a href="{!! url('loai-san-pham/'.$item['id'].'/'.$item['alias']) !!}">{!! $item['name'] !!}</a>
									<?php subMenu($cate, $item['id']); ?>
								</li>
							@endif
							@endforeach
						</ul>
					</li>
					<li><a href="{{ route('getAbout') }}">Giới thiệu</a></li>
					@if(Auth::check())
					<li><a href="#">Khác</a>
						<ul class="sub-menu">
							<li><a href="#" class="suggest">Đề xuất SP</a></li>
							<li><a href="#" class="suggest">Phản hồi</a></li>
							<li><a href="{{ route('getHistoryOrder') }}">Lịch sử đặt hàng</a></li>
						</ul>
					</li>
					<li><a href="{{ route('getProfile') }}">Hồ sơ</a></li>
					@endif
					@if(Auth::check() && Auth::user()->level != 0)
					<li><a href="{{ url('admin') }}">Trang admin</a></li>
					@endif
				</ul>
				<div class="clearfix"></div>
			</nav>
		</div> <!-- .container -->
	</div> <!-- .header-bottom -->
</div> <!-- #header -->
<div class="modal fade" id="Search" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tìm kiếm</h4>
        </div>
        <form role="search" method="get" id="searchform" action="{!! route('getSearch') !!}">
	        <div class="modal-body">
	      		<table>
	      		<tr>
	      		<td style="padding-right: 10px;">
					<select name="searchOrder" class="form-control" style="width: 170px;">
						<option value="1">Sắp xếp</option>
						<option value="2">Đơn giá Cao-Thấp</option>
						<option value="3">Đơn giá Thấp-Cao</option>	
						<option value="4">Đánh giá Cao-Thấp</option>
						<option value="5">Đánh giá Thấp-Cao</option>
					</select>
				</td>
				<td>
			        <input type="text" value="" name="key" placeholder="Nhập từ khóa..." style="width: 170%; height: 34px;"/>
			     </td>
		        </tr>
		        </table>
	        </div>
	        <div class="modal-footer">
	        	<button type="submit" title="Tìm kiếm" class="btn btn-default">Tìm kiếm</button>
	          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
        </form>
      </div>
    </div>
  </div>