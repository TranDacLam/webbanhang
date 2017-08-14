@extends('admin.layouts.master')
@section('title', 'Admin')
@section('content')
<section class="content-header">
  <h1>
    Đơn đặt hàng
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Trang Admin</a></li>
    <li><a href="{{ route('getIndexOrder') }}">Danh sách đơn hàng</a></li>
    <li class="active">Invoice</li>
  </ol>
</section>

<div class="pad margin no-print">
  <div class="callout callout-info" style="margin-bottom: 0!important;">
    <h4><i class="fa fa-info"></i> Note:</h4>
    @if($bill['note'] == null)
      Không có ghi chú
    @else
      {{$bill['note']}}
    @endif
  </div>
</div>

<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-user"></i> Người đặt: {{$bill['customer']['name']}}
        <small class="pull-right">Ngày đặt hàng: {{$bill['date_order']}}</small>
      </h2>
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      Từ:
      <address>
        <strong>{{$bill['customer']['name']}}.</strong><br>
        Giới tính: {{$bill['customer']['gender']}}<br>
        Địa chỉ: {{$bill['customer']['address']}}<br>
        SĐT: {{$bill['customer']['phone']}}<br>
        Email: {{$bill['customer']['email']}}
      </address>
    </div>
    <div class="col-sm-4 invoice-col">
      Đến:
      <address>
        <strong>Admin</strong><br>
        Email: tdlam2105@gmail.com
      </address>
    </div>
    <div class="col-sm-4 invoice-col">
      <b>ID:</b> {{$bill['id']}}<br>
      <b>Thanh toán:</b> {{$bill['payment']}}<br>
      <b>Tổng tiền:</b> {{number_format($bill['total'])}} vnđ
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Số lượng</th>
          <th>Đơn giá</th>
          <th>Giá khuyến mãi</th>
          <th>Sản phẩm</th>
          <th>Thành tiền</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
          <tr>
            <td>{{number_format($item->quantily)}}</td>
            <td>{{number_format($item->unit_price)}}</td>
            @if($item->promotion_price == 0)
              <td>Không có</td>
            @else
              <td>{{number_format($item->promotion_price)}}</td>
            @endif
            <td>{{$item->name}}</td>
            @if($item->promotion_price == 0)
              <td>{{ number_format(subTotal($item->quantily, $item->unit_price)) }}</td>            
            @else
              <td>{{ number_format(subTotal($item->quantily, $item->promotion_price)) }}</td>
            @endif
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <p class="lead">Phương thức thanh toán:</p>
      <img src="source/assets/admin/img/credit/visa.png" alt="Visa">
      <img src="source/assets/admin/img/credit/mastercard.png" alt="Mastercard">
      <img src="source/assets/admin/img/credit/american-express.png" alt="American Express">
      <img src="source/assets/admin/img/credit/paypal2.png" alt="Paypal">
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Làm màu thôi =))
      </p>
    </div>
    <div class="col-xs-6">
      <p class="lead"></p>
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Shipping:</th>
            <td>Miễn phí</td>
          </tr>
          <tr>
            <th>Tổng tiền:</th>
            <td>{{number_format($bill['total'])}} vnđ</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</section>
<div class="clearfix"></div>
@endsection