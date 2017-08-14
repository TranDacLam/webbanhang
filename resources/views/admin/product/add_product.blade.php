@extends('admin.layouts.master')
@section('title', 'Admin')
@section('content')
<section class="content-header">
  <h1>
    Sản phẩm
    <small>Tạo mới sản phẩm</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Admin</a></li>
    <li class="active">Tạo mới sản phẩm</li>
  </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-xs-12" style="width: 80%; margin-left: 10%">
        <div class="box">
        <form action="" method="post" class="beta-form-checkout" role="form" enctype="multipart/form-data">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Tên sản phẩm</label>
                     <input type="text" class="form-control" name="txtName" placeholder="Tên sản phẩm" value="{!! old('txtName') !!}" required>
                  </div>
                  <div class="form-group">
                     <label>Thể loại</label>
                     <select name="sltCate" class="form-control">
                        <?php menuMulti($cate, 0, $str="", old('sltCate')); ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Đơn giá</label>
                     <input type="text" class="form-control" name="txtUnitPrice" placeholder="đơn giá" value="{!! old('txtUnitPrice') !!}" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Giá khuyến mãi</label>
                     <input type="text" class="form-control" name="txtPromotionPrice" placeholder="Giá khuyến mãi" value="{!! old('txtPromotionPrice') ? old('txtPromotionPrice') : 0 !!}">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Đợn vị</label>
                     <input type="text" class="form-control" name="txtUnit" placeholder="Cái/Hộp/Cây/..." value="{!! old('txtUnit') !!}" required>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Hình ảnh</label>
                     <input type="file" name="fileImagePro" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" name="areaDescription" rows="5" placeholder="Enter ..." required>{!! old('areaDescription') !!}</textarea>
                  </div>
                  <br>
                  <span class="orm-group">
                    <label for="exampleInputEmail1" style="margin-right: 100px;">Sản phẩm mới</label>
                    <input type="checkbox" name="cknew"  checked="checked" checked/>
                  </span>
                  <br />
                  <span class="form_label"></span>
               </div>
               <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Tạo</button>
               </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
