@extends('layouts.master')
@section('title', 'Chi tiết')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">{!! $product['name'] !!}</h6>
			</div>
			<div class="pull-right">
				<div class="font-large">
					<a href="{!! route('getIndex') !!}">Trang chủ</a> / <span>{!! $product['category']['name'] !!}</span> / <span>{!! $product['name'] !!}</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-4">
							<img src="source/image/product/{!! $product['image'] !!}" alt="" height="300px">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title font-large">{!! $product['name'] !!}</p>
								<p class="single-item-price">
									@if($product['promotion_price'] == 0)
										<span class="flash-sale" >{!! number_format($product['unit_price']) !!} vnđ</span>
									@else
										<span class="flash-del" style="font-size: 15px;">{!! number_format($product['unit_price']) !!} vnđ</span>
										<span class="flash-sale">{!! number_format($product['promotion_price']) !!} vnđ</span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="beta-breadcrumb font-large">
								Thể loại: {!! $product['category']['name'] !!}
							</div>
							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="beta-breadcrumb font-large">
								<div class="fb-like" data-href="" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
							</div>
							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>
							<div class="beta-breadcrumb font-large" id="stars-existingr-{!! $product['id'] !!}">
							</div>
							<div class="beta-breadcrumb font-large" id="stars-existing-{!! $product['id'] !!}">
								<div id="stars-existing" class="starrr" data-rating="{!! $product['avg_rate'] !!}" data-product="{!! $product['id'] !!}" style="color: orange; font-size: 25px;"></div>
							</div>
							<div class="space20">&nbsp;</div>
							<div class="space20">&nbsp;</div>
							<p>Số lượng</p>
							<div class="single-item-options">
								<input type="number" value="1" name="quantily" min="1" class="form-control text-center" id="quantilyDetaiPro-{{ $product['id'] }}" style="width: 90px; font-weight: bold;" />
								<a class="add-to-cart" href="#" data-product-id="{{ $product['id'] }}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả</a></li>
							<li><a href="#tab-reviews">Bình luận</a></li>
						</ul>
						<div class="panel" id="tab-description">
							<p>{!! $product['description'] !!}</p>
						</div>
						<div class="panel" id="tab-reviews">
							<div class="col-sm-12">
						        <div class="panel-white post panel-shadow">
									<div class="post-footer">
									<span class="comment-hide">
									@if(Auth::check())
									{!! Form::open(array('method'=>'POST', 'id'=>'myform', 'action'=>'PageController@postComment', 'class'=>'beta-form-checkout')) !!}
						                <div class="input-group"> 
						                	{{ Form::hidden('p_id', $product->id) }}
						                    {!! Form::text('content', null, ['placeholder'=>'Bình luận...', 'class'=>'form-control', 'required'=>'required']) !!}
						                    <span class="input-group-addon">
						                    	{!! Form::submit('Bình luận',['class'=>'btn btn-default btn-sm add-comment', 'style'=>'line-height: 1']) !!} 
						                    </span>
						                </div>
						            {!! Form::close() !!}
						            @else
						            	Bạn cần đăng nhập để bình luận...
						            @endif
						            </span>
						                <ul class="comments-list" id="comment-parent-{{ $product->id }}">
						                	@foreach($comment as $cmt)
						                	@if($cmt['parent_id'] == 0)
						                    <li class="comment" id="del-comment-{{ $cmt['id'] }}">
						                        <span class="pull-left">
						                            <img class="avatar" src="http://bootdey.com/img/Content/user_1.jpg" alt="avatar">
						                    	</span>
						                        <div class="comment-body">
						                            <div class="comment-heading">
						                                <h4 class="user">{{ $cmt['user']['full_name'] }}</h4>
						                                <h5 class="time">
						                                	{!! \Carbon\Carbon::createFromTimeStamp(strtotime($cmt['created_at']))->diffForHumans() !!}  &ensp;
						                                	<span class="comment-hide">
						                                	@if(Auth::id() == $cmt['user']['id'])
							                                <a href="#" class="del-comment" title="xóa" data-cmt-id="{{ $cmt['id'] }}"><i class="fa fa-trash-o"></i>
							                                </a>
							                                <a href="#" class="edit-comment" title="chỉnh sửa" data-cmt-id="{{ $cmt['id'] }}"><i class="fa fa-pencil-square-o"></i>
							                                </a>
							                                @endif
							                                </span>
						                                </h5>             
						                            </div>
						                            <p><span id="edit-comment-{{ $cmt['id'] }}">{{ $cmt['content'] }}</span></p>
						                            <p class="text-right comment-hide">
						                            	@if($comment->where('parent_id', $cmt['id'])->count() != 0)
						                            	<a class="btn btn-default btn-sm btn-circle text-uppercase " data-toggle="collapse" href="#"><span class="glyphicon glyphicon-comment"></span> <span id="count-reply-{{ $cmt['id'] }}">{{ $comment->where('parent_id', $cmt['id'])->count() }}</span> comment</a>
						                            	@endif
						                            	@if($comment->where('parent_id', $cmt['id'])->count() != 0 || Auth::check())
						                            	<a href="#reply{{ $cmt['id'] }}" data-toggle="collapse" class="btn btn-default btn-sm reply-cmt text-uppercase" data-comment-id={{ $cmt['id'] }}><i class="fa fa-reply"></i> reply</a>
						                            	@endif
						                            </p>
						                        </div>
						                        <ul class="comments-list collapse" id="reply{{ $cmt['id'] }}">
						                        	@foreach($comment as $cmt_child)
						                        	@if($cmt_child['parent_id'] == $cmt['id'])
						                            <li class="comment" id="del-reply-{{ $cmt_child['id'] }}">
						                                <a class="pull-left" href="#">
						                                    <img class="avatar" src="http://bootdey.com/img/Content/user_3.jpg" alt="avatar">
						                                </a>
						                                <div class="comment-body">
						                                    <div class="comment-heading">
						                                        <h4 class="user">{{ $cmt_child['user']['full_name'] }}</h4>
						                                        <h5 class="time">
						                                        {!! \Carbon\Carbon::createFromTimeStamp(strtotime($cmt_child['created_at']))->diffForHumans() !!}
						                                        &ensp;
						                                        <span class="comment-hide">
						                                        @if(Auth::id() == $cmt_child['user']['id'])
						                                        <a href="#" class="del-comment-reply" title="xóa" data-cmt-id="{{ $cmt_child['id'] }}" data-cmt-parent="{{ $cmt['id'] }}"><i class="fa fa-trash-o"></i>
							                                	</a>
							                                	<a href="#" class="edit-comment" title="chỉnh sửa" data-cmt-id="{{ $cmt_child['id'] }}"><i class="fa fa-pencil-square-o"></i>
							                                	</a>
							                                	@endif
							                                	</span>
						                                        </h5>
						                                    </div>
						                                    <p><span id="edit-comment-{{ $cmt_child['id'] }}">{{ $cmt_child['content'] }}</p></span>
						                                </div>
						                            </li> 
						                            @endif
						                            @endforeach
						                            <span class="comment-hide">
						                            @if(Auth::check())
										                <div class="input-group"> 
										                	<input placeholder="Trả lời..." class="form-control" name="content_reply" id="content-reply-{{ $cmt->id }}" type="text" required/>
										                    <span class="input-group-addon"> 
										                    	<input class="btn btn-default btn-sm add-comment_reply" style="line-height: 1" data-p-id="{{ $product->id }}" data-parent-id="{{ $cmt->id }}" type="submit" value="Trả lời">
										                    </span>
										                </div>
										            @endif
										            </span>
						                        </ul>
							              	</li>
							              	@endif
						                    @endforeach
						                </ul>
						            </div>
						        </div>
						    </div>
						    <div class="space50">&nbsp;</div>
						    <div class="space50">&nbsp;</div>
							<div class="fb-comments" data-href="" data-width="820px" data-numposts="10"></div>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm liên quan</h4>

						<div class="row">
							@foreach($same_product as $sp)
							<div class="col-sm-4">
								<div class="beta-products-details">
								</div>
								<div class="single-item">
									<div class="single-item-header">
										<a href="{!! url('chi-tiet-san-pham/'.$sp['id'].'/'.$sp['alias']) !!}"><img src="source/image/product/{!! $sp['image'] !!}" alt="" height="150px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{!! $sp['name'] !!}</p>
										<p class="single-item-price">
											@if($sp['promotion_price'] == 0)
												<span class="flash-sale" >{!! number_format($sp['unit_price']) !!} vnđ</span>
											@else
												<span class="flash-del" style="font-size: 15px;">{!! number_format($sp['unit_price']) !!} vnđ</span>
												<span class="flash-sale">{!! number_format($sp['promotion_price']) !!} vnđ</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="#" data-product-id="{{ $sp['id'] }}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{!! url('chi-tiet-san-pham/'.$sp['id'].'/'.$sp['alias']) !!}">Chi tiết <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="row text-center">{{$same_product->links()}}</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới nhất</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($new_product as $np)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{!! url('chi-tiet-san-pham/'.$np['id'].'/'.$np['alias']) !!}"><img src="source/image/product/{!! $np['image'] !!}" alt="" height="58px"></a>
									<div class="media-body">
										{!! $np['name'] !!} <br>
										<span class="beta-sales-price">
											@if($np['promotion_price'] == 0)
												<span class="flash-sale" >{!! number_format($np['unit_price']) !!} vnđ</span>
											@else
												<span class="flash-del" style="font-size: 15px;">{!! number_format($np['unit_price']) !!} vnđ</span>
												<span class="flash-sale">{!! number_format($np['promotion_price']) !!} vnđ</span>
											@endif
										</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sản phẩm khuyến mãi</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($promotion_product as $pp)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{!! url('chi-tiet-san-pham/'.$pp['id'].'/'.$pp['alias']) !!}"><img src="source/image/product/{!! $pp['image'] !!}" alt="" height="58px"></a>
									<div class="media-body">
										{!! $pp['name'] !!} <br>
										<span class="beta-sales-price">
											@if($pp['promotion_price'] == 0)
												<span class="flash-sale" >{!! number_format($pp['unit_price']) !!} vnđ</span>
											@else
												<span class="flash-del" style="font-size: 15px;">{!! number_format($pp['unit_price']) !!} vnđ</span>
												<span class="flash-sale">{!! number_format($pp['promotion_price']) !!} vnđ</span>
											@endif
										</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection