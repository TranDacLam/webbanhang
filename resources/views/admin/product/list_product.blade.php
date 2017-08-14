@extends('admin.layouts.master')
@section('title', 'Admin')
@section('content')
<section class="content-header">
  <h1>
    Sản phẩm
    <small>danh sách sản phẩm</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Admin</a></li>
    <li class="active">Danh sách sản phẩm</li>
  </ol>
</section>
<section class="content-header" style="padding-top: 50px;">
  <div>
    <a  class="btn btn-primary btn-lg" href="{!! route('getAddProduct') !!}">
      <i class="fa fa-th-list"> Tạo mới sản phẩm</i>
    </a>
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
              <th>Tên</th>
              <th>Hình ảnh</th>
              <th>Đơn giá</th>
              <th>Giá khuyến mãi</th>
              <th>Thể loại</th>
              <th>Hành động</th>
            </tr>
            @foreach($data as $product)
            <tr>
              <td><a href="{!! url('chi-tiet-san-pham/'.$product['id'].'/'.$product['alias']) !!}" target="_blank">{!! $product['name'] !!}</a></td>
              <td><img src="source/image/product/{!! $product['image'] !!}" height="75px;" /></td>
              <td>{!! $product['unit_price'] !!}</td>
              <td>{!! $product['promotion_price'] !!}</td>
              <td>{!! $product['category']['name'] !!}</td>
              <td>
                <a href="{!! route('getEditProduct', $product['id']) !!}"><img src="../public/source/assets/admin/img/edit.png" title="Chỉnh sửa" /></a>&nbsp;&nbsp;&nbsp;
                <a href="{!! route('getDelProduct',$product['id']) !!}" onclick="return confirmDel('Bạn có đồng ý xóa không?')" title="Xóa"><img src="../public/source/assets/admin/img/delete.png" /></a>
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