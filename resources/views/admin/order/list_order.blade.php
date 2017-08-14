@extends('admin.layouts.master')
@section('title', 'Admin')
@section('content')
<section class="content-header">
  <h1>
    Đơn đặt hàng
    <small>danh sách đơn đặt hàng</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('admin') }}"><i class="fa fa-home"></i> Trang Admin</a></li>
    <li class="active">Danh sách đơn đặt hàng</li>
  </ol>
</section>
<section class="content-header" style="padding-top: 50px;">
  <div>
    
  </div>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách sản phẩm</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>Người đặt</th>
              <th>Số đt</th>
              <th>Ngày đặt</th>
              <th>Tổng tiền</th>
              <th>Thanh toán</th>
              <th>Hành động</th>
            </tr>
            @foreach($data as $order)
            <tr>
              <td>{{ $order['customer']['name'] }}</td>
              <td>{{ $order['customer']['phone'] }}</td>
              <td>{!! $order['date_order'] !!}</td>
              <td>{!! $order['total'] !!} vnđ</td>
              <td>{!! $order['payment'] !!}</td>
              <td>
                <a href="{!! route('getDetailOrder', $order['id']) !!}"><img src="../public/source/assets/admin/img/eye.png" title="Xem chi tiết" /></a>&nbsp;&nbsp;&nbsp;
                <a href="{!! route('getDelOrder',$order['id']) !!}" onclick="return confirmDel('Bạn có đồng ý xóa không?')" title="Xóa"><img src="../public/source/assets/admin/img/delete.png" /></a>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
        <div class="row text-center">{{$data->links()}}</div>
      </div>
    </div>
  </div>
</section>
@endsection