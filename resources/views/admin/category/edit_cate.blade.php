@extends('admin.layouts.master')
@section('title', 'Admin')
@section('content')
<section class="content-header">
  <h1>
    Thể loại
    <small>Chỉnh sửa thể loại</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Admin</a></li>
    <li class="active">Chỉnh sửa Thể loại</li>
  </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-xs-12" style="width: 500px; margin-left: 25%">
      	<div class="box">
        <form action="" method="post" class="beta-form-checkout" role="form">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <div class="box-body">
                  <div class="form-group">
                     <label>Thể loại cha</label>
                     <select name="sltCate" class="form-control">
                        <option value="0">--- ROOT ---</option>
                        <?php menuMulti($cate, 0, $str="---|", $data['parent_id']); ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Tên thể loại</label>
                     <input type="text" class="form-control" name="txtNameCate" placeholder="Tên thể loại" value="{!! old('txtNameCate', isset($data["name"]) ? $data["name"] : null) !!}" required>
                  </div>
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
