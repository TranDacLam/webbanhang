@extends('admin.layouts.master')
@section('title', 'Admin')
@section('content')
<section class="content-header">
  <h1>
    Thành viên
    <small>danh sách thành viên</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Admin</a></li>
    <li class="active">Danh sách Thành viên</li>
  </ol>
</section>
<section class="content-header" style="padding-top: 50px;">
  <div>
    <a  class="btn btn-primary btn-lg" href="{!! route('getAddUser') !!}">
      <i class="fa fa-th-list"> Tạo mới thành viên</i>
    </a>
  </div>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách thành viên</h3>

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
              <th>STT</th>
              <th>Họ tên</th>
              <th>Email</th>
              <th>Ngày tạo</th>
              <th>Hành động</th>
            </tr>
            <?php $i = 0 ?>
            @foreach($data as $user)
            <?php $i++ ?>
            <tr>
              <td>{!! $i !!}</td>
              <td>{!! $user['full_name'] !!}</td>
              <td>{!! $user['email'] !!}</td>
              <td>{!! $user['created_at'] !!}</td>
              <td>
                <a href="{!! route('getEditUser', $user['id']) !!}"><img src="../public/source/assets/admin/img/edit.png" title="Chỉnh sửa"/></a>&nbsp;&nbsp;&nbsp;
                <a href="{!! route('getDelUser',$user['id']) !!}" onclick="return confirmDel('Bạn có đồng ý xóa không?')" title="Xóa"><img src="../public/source/assets/admin/img/delete.png" /></a>
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