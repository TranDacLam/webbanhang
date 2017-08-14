<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use DB;

class OrderController extends Controller
{
    public function getIndexOrder(){
    	$data = Bill::with('customer')->paginate(10);
    	return view('admin.order.list_order',['data'=>$data]);
    }

    public function getDetailOrder($id){
    	$bill = Bill::with('customer')->find($id);
    	$data = DB::table('bill_details')
            ->leftJoin('bills', 'bill_details.bill_id', '=', 'bills.id')
            ->leftJoin('products', 'bill_details.product_id', '=', 'products.id')
            ->where('bill_id',$bill['id'])
            ->get();
    	return view('admin.order.detail_order',['data'=>$data, 'bill'=>$bill]);
    }
}
