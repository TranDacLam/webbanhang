@extends('admin.layouts.master')
@section('title', 'Admin')
@section('content')
<section class="content-header">
  <h1>
    Thể loại
    <small>danh sách thể loại</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Admin</a></li>
    <li class="active">Danh sách Thể loại</li>
  </ol>
</section>
<section class="content-header" style="padding-top: 50px;">
  <div>
    <a  class="btn btn-primary btn-lg" href="{!! route('getAddCate') !!}">
      <i class="fa fa-th-list"> Tạo mới thể loại</i>
    </a>
  </div>
</section>
<section class="content">
<div class="row">
   <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh sách thể loại</h3>
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
                 <th>Tên thể loại</th>
                 <th>Hành động</th>
               </tr>
               <?php listCate($cate); ?>
            </table>
         </div>
      </div>
   </div>
</div>
</section>
@endsection