<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductAddRequest;
use DateTime;

class ProductController extends Controller
{
    public function getListProduct(){
    	$data = Product::with('category')->orderBy('created_at','DESC')->paginate(10);
    	return view('admin.product.list_product',['data'=>$data]);
    }

    public function getAddProduct(){
    	$cate = Category::all();
    	return view('admin.product.add_product',['cate'=>$cate]);
    }

    public function postAddProduct(ProductAddRequest $request){
    	$pro = new Product();
    	$file = $request->file('fileImagePro');
    	$pro->name = $request->txtName;
    	$pro->alias = str_slug($request->txtName,'-');
    	$pro->description = $request->areaDescription;
    	$pro->unit_price = $request->txtUnitPrice;
    	$pro->promotion_price = $request->txtPromotionPrice;
    	$pro->unit = $request->txtUnit;
        if($request->cknew == "on"){
            $pro->new = 1;
        }else{
            $pro->new = 0;
        }
    	if(strlen($file) > 0){
    		$filename = time().'.'.$file->getClientOriginalName();
    		$destinationPath = 'source/image/product/';
    		$file->move($destinationPath, $filename);
    		$pro->image = $filename;
    	}
    	$pro->category_id = $request->sltCate;
    	$pro->created_at = new DateTime();
    	$pro->save();
    	return redirect()->route('getListProduct')->with(['flash_level' => 'success','flash_message' => 'Thêm sản phẩm thành công']);
    }

    public function getEditProduct($id){
        $cate = Category::all();
        $data = Product::with('category')->find($id);
        return view('admin.product.edit_product',['data'=>$data,'cate'=>$cate]);
    }

    public function postEditProduct(Request $request, $id){
        $pro = Product::find($id);
        $file = $request->file('fileImagePro');
        $pro->name = $request->txtName;
        $pro->alias = str_slug($request->txtName,'-');
        $pro->description = $request->areaDescription;
        $pro->unit_price = $request->txtUnitPrice;
        $pro->promotion_price = $request->txtPromotionPrice;
        $pro->unit = $request->txtUnit;
        if($request->cknew == "on"){
            $pro->new = 1;
        }else{
            $pro->new = 0;
        }
        if(strlen($file) > 0){
            $imageCurrent = $request->fImageCurrent;
            if(file_exists(public_path().'source/image/product/'.$imageCurrent)){
                unlink(public_path().'source/image/product/'.$imageCurrent);
            }
            $filename = time().'.'.$file->getClientOriginalName();
            $destinationPath = 'source/image/product/';
            $file->move($destinationPath, $filename);
            $pro->image = $filename;
        }
        $pro->category_id = $request->sltCate;
        $pro->updated_at = new DateTime();
        $pro->save();
        return redirect()->route('getListProduct')->with(['flash_level' => 'success','flash_message' => 'Cập nhập sản phẩm thành công']);
    }

    public function getDelProduct($id){
        $pro = Product::find($id);;
        if(file_exists(public_path().'/source/image/product/'.$pro->image)){
            unlink(public_path().'/source/image/product/'.$pro->image);
        }
        $pro->delete();
        return redirect()->route('getListProduct')->with(['flash_level' => 'success','flash_message' => 'Xóa sản phẩm thành công']);
    }
}
