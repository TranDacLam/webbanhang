@extends('layouts.master')
@section('title', 'Hồ sơ')
@section('content')
<div class="inner-header">
    <div class="container" style="color: blue;">
        <div class="pull-left">
            <h6 class="inner-title">Chi tiết đơn đặt hàng</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('getIndex') }}">Trang chủ</a> / <span>Chi tiết đơn đặt hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container" style="padding-bottom: 10%;">
    <div class="row item-job-list ">
        @foreach($data as $item)
        <div class="col-sm-3 col-md-3 block-col block-col-1">
            <p class="block-pid block-hdr"> {{ $item['product']['name'] }}</p>
            <p class="block-application block-hdr"> <img src="source/image/product/{!! $item['product']['image'] !!}" alt="" height="100px"></p>
            <p class="block-type block-hdr"> {{ $item['quantily'] }}</p>
            <p class="block-status block-hdr"> {{ number_format($item['product']['unit_price']) }} vnđ</p> 
            <p class="block-organization block-hdr"> {{ $item['product']['promotion_price'] }} vnđ</p> 
        </div> 
        @endforeach
        <div class="col-sm-3 col-md-3 block-col block-col-4">

            <ul class="block-toolbar">
                <p class="block-last-execution block-hdr"> : 
                {!! $item['bill']['payment'] !!}
            </p>
            <p class="block-next-execution block-hdr"> :
                {!! $item['bill']['date_order'] !!}
            </p>
            <p class="block-recurring block-hdr"> : 
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
            </p>  <br>
            <p class="item-block-application-id"> {!! number_format($item['bill']['total']) !!} vnđ</p><br>
            <a href="{{ route('getHistoryOrder') }}"><li class="btn btn-default btn-sm btn-success"><i class="fa fa-toggle-off"></i> Quay lại</li></a>
        </div>
    </div>
</div>
@endsection