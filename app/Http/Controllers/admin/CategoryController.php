<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CateAddRequest;
use DateTime;

class CategoryController extends Controller
{
	public function getListCate(){
		$cate = Category::select('id','name','parent_id','created_at')->get();
    	return view('admin.category.list_cate', ['cate'=>$cate]);
    }

    public function getAddCate(){
    	$cate = Category::select('id','name','parent_id')->get()->toArray();
    	return view('admin.category.add_cate',['cate'=>$cate]);
    }

    public function postAddCate(CateAddRequest $request){
    	$cate = new Category();
    	$cate->name = $request->txtNameCate;
    	$cate->alias = str_slug($request->txtNameCate,"-");
    	$cate->parent_id = $request->sltCate;
    	$cate->created_at = new DateTime();
    	$cate->save();
    	return redirect()->route('getListCate')->with(['flash_level' => 'success','flash_message' => 'Bạn đã tạo thể loại thành công']);
    }

    public function getEditCate($id){
    	$data = Category::findOrFail($id)->toArray();
    	$cate = Category::select('id','name','parent_id')->get()->toArray();
    	return view('admin.category.edit_cate',['data'=>$data,'cate'=>$cate]);
    }

    public function postEditCate(Request $request, $id)
    {
    	$cate = Category::find($id);
        $cate->name = $request->txtNameCate;
        $cate->alias = str_slug($request->txtNameCate,"-");
        $cate->parent_id = $request->sltCate;
        $cate->updated_at = new DateTime();
        $cate->save();
        return redirect()->route('getListCate')->with(['flash_level' => 'success','flash_message' => 'Cập nhập danh mục thành công']);
    }

    public function getDelCate($id)
    {
        $status = false;
    	$parent = Category::where('parent_id', $id)->count();
    	if($parent == 0){
    		$cate = Category::find($id);
    		$cate->delete();
            $status = true;
            $response = array(
                    'status' => $status
                );
            return response()->json($response); 
    		// return redirect()->route('getListCate')->with(['flash_level' => 'result_msg','flash_message' => 'Bạn đã xóa thành công']);
    	}else{
            $status = false;
            $response = array(
                    'status' => $status
                );
            return response()->json($response); 
    		// return redirect()->route('getListCate')->with(['flash_level' => 'error_msg','flash_message' => 'Lỗi']);
    	}
    }
}
