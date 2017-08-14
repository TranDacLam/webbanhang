@extends('layouts.master')
@section('title', 'Hồ sơ')
@section('content')
<div class="container">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Chỉnh sửa hồ sơ</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="source/assets/admin/img/avatar5.png"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                <form action="" method="post" class="beta-form-checkout">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <table class="table table-user-information">
                    <tbody>
                      <div class="form-block">
                        <label for="your_last_name">Họ tên*</label>
                        <input type="text" id="your_last_name" name="txtFullName" value="{{ Auth::user()->full_name }}" required>
                      </div>
                      <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="txtEmail" value="{{ Auth::user()->email }}" required>
                      </div>
                      <div class="form-block">
                        <label for="phone">Password*</label>
                        <input type="password" id="phone" name="txtPass" style="border: 1px solid #e1e1e1;
                            height: 37px;">
                      </div>
                      <div class="form-block">
                        <label for="phone">Re password*</label>
                        <input type="password" id="phone" name="txtRepass" style="border: 1px solid #e1e1e1;
                            height: 37px;">
                      </div>
                    </tbody>
                  </table>
                  <div class="form-block" style="padding-left: 15%;">
                    <button type="submit" class="btn btn-primary">Cập nhập</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
              <div class="panel-footer">
                <a href="{{ route('getProfile') }}" title="Quay lại" data-toggle="tooltip" class="btn btn-sm btn-primary">Quay lại</a>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection