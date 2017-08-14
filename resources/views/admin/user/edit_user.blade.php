@extends('admin.layouts.master')
@section('title', 'Admin')
@section('content')
<section class="content-header">
  <h1>
    Thành viên
    <small>Chỉnh sửa thành viên</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Admin</a></li>
    <li class="active">Chỉnh sửa Thành viên</li>
  </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-xs-12" style="width: 70%; margin-left: 15%">
        <div class="box">
        <form action="" method="post" class="beta-form-checkout" role="form">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Họ tên</label>
                     <input type="text" class="form-control" name="txtFullName" placeholder="Họ tên" value="{!! isset($user['full_name']) ? $user['full_name'] : null !!} " required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email</label>
                     <input type="email" class="form-control" name="txtEmail" placeholder="example@gmail.com" value="{!! isset($user['email']) ? $user['email'] : null !!}" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Mật khẩu</label>
                     <input type="password" class="form-control" name="txtPass" placeholder="*******" >
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Xác nhận Mật khẩu</label>
                     <input type="password" class="form-control" name="txtRepass" placeholder="*******" >
                  </div>
                  <span class="orm-group">
                    <label for="exampleInputEmail1" style="margin-right: 100px;">Vai trò</label>
                    <input type="radio" name="rdoLevel" value="1" checked="checked" 
                      @if($user['level'] == 1)
                        checked
                      @endif
                    /> Admin 
                    <input type="radio" name="rdoLevel" value="0"  style="margin-left: 50px;" 
                      @if($user['level'] == 0)
                        checked
                      @endif
                    /> Member
                  </span><br />
                  <span class="form_label"></span>
               </div>
               <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Cập nhập</button>
               </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
