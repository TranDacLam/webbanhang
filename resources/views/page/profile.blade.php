@extends('layouts.master')
@section('title', 'Hồ sơ')
@section('content')

<div class="container">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{ Auth::user()->full_name }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="source/assets/admin/img/avatar5.png"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Họ tên:</td>
                        <td>{{ Auth::user()->full_name }}</td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td>{{ Auth::user()->email }}</td>
                      </tr>
                      <tr>
                        <td>Password</td>
                        <td>*********</td>
                      </tr>
                      <tr>
                        <td>Giới tính:</td>
                        <td>Bóng</td>
                      </tr>
                      <tr>
                        <td>Vai trò:</td>
                        <td>
                          @if(Auth::user()->level == 0)
                            Thành viên
                          @else
                            Admin
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
              <div class="panel-footer">
                <a href="{{ route('getHistoryOrder') }}" title="Lịch sử đặt hàng" data-toggle="tooltip" class="btn btn-sm btn-primary">Lịch sử đặt hàng</a>
                <span class="pull-right">
                    <a href="{{ route('getEditProfile') }}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning">Chỉnh sửa<i class="glyphicon glyphicon-edit"></i></a>
                </span>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection