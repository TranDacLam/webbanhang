<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use DateTime;
use Hash;

class UserController extends Controller
{
	public function getListUser(){
		$data = User::select('id','full_name','email','created_at')->orderBy('created_at','DESC')->paginate(10);
		return view('admin.user.list_user',['data'=>$data]);
	}

	public function getAddUser(){
		return view('admin.user.add_user');
	}

    public function postAddUser(SignUpRequest $request){
        $user = new User();
        $user->full_name = $request->txtFullName;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtPass);
        $user->level = $request->rdoLevel;
        $user->created_at = new DateTime();
        $user->save();
        return redirect()->route('getListUser')->with(['flash_level' => 'success','flash_message' => 'Tạo tài khoản thành công']);
    }

    public function getDelUser($id){
    	$user = User::find($id);
    	$user->delete();
    	return redirect()->route('getListUser')->with(['flash_level' => 'success','flash_message' => 'Xóa tài khoản thành công']);
    }

    public function getEditUser($id){
    	$user = User::find($id);
    	return view('admin.user.edit_user',['user'=>$user]);
    }

    public function postEditUser(Request $request, $id){
    	$user = User::find($id);
    	if($request->txtPass){
    		$this->validate($request,
    			[
    				'txtRepass' => 'same:txtPass'
    			],
    			[
					'txtRepass.same' => "Xác nhận mật khẩu không đúng."
				]
    		);
    		$user->password = Hash::make($request->txtPass);
    	}
    	$user->full_name = $request->txtFullName;
        $user->email = $request->txtEmail;
        $user->level = $request->rdoLevel;
        $user->updated_at = new DateTime();
        $user->save();
        return redirect()->route('getListUser')->with(['flash_level' => 'success','flash_message' => 'Cập nhập tài khoản thành công']);
    }
}
