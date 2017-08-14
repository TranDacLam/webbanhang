<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\User;
use App\Models\Rate;
use App\Models\Comment;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\CheckoutRequest;
use Auth;
use Session;
use DateTime;
use Hash;

class PageController extends Controller
{
    public function getIndex(){
    	$slide = Slide::all();
    	$other_product = Product::orderBy('created_at','DESC')->paginate(8);
    	$new_product = Product::where('new',1)->paginate(4);
    	$promotion_product = Product::where('promotion_price','<>',0)->paginate(4);
    	return view('page.home',['slide'=>$slide, 'new_product'=>$new_product,'promotion_product'=>$promotion_product, 'other_product'=>$other_product]);
    }

    public function getCategory($id){
    	$cate = Category::all();
    	$cate_prodcut = Category::find($id);
    	$new_product = Product::where([['category_id', $id],['new',1]])->paginate(6);
    	$promotion_product = Product::where('category_id',$id)->paginate(6);
    	return view('page.category', ['cate'=>$cate,'cate_product'=>$cate_prodcut, 'new_product'=>$new_product, 'promotion_product'=>$promotion_product]);
    }

    public function getDetail($id){
    	$product = Product::with('category')->find($id);
    	$same_product = Product::where('category_id',$product->category_id)->paginate(6);
    	$new_product = Product::where('new',1)->orderBy('created_at','DESC')->limit(4)->get();
    	$promotion_product = Product::where('promotion_price','<>',0)->limit(4)->get();
        $comment = Comment::with('user')->where('product_id', $id)->orderBy('created_at','DESC')->get();
    	return view('page.product_detail',['product'=>$product, 'same_product'=>$same_product, 'new_product'=>$new_product,'promotion_product'=>$promotion_product, 'comment'=>$comment]);
    }

    public function getContact(){
    	return view('page.contact');
    }

    public function getAbout(){
    	return view('page.about');
    }
    
    public function getAddToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $status = true;
        if($request->quantily_cart){
            $qty_pre = $request->quantily_cart;
            if($qty_pre < 1){
                $status = false;
                $subTotalQty = $cart->items[$id]['qty'];
                $response = array(
                    'subTotalQty' => $subTotalQty,
                    'status' => $status
                );
                return response()->json($response);
            }
            $qty_old = session('cart')->items[$id]['qty'];
            if($qty_old > $qty_pre){
                $quantily = -($qty_old - $qty_pre);
            }else{
                $quantily = $qty_pre - $qty_old;
            }
        }else{  
            $quantily = $request->quantily;
            if($quantily < 1){
                $status = false;
                $response =array(
                    'status' => $status
                );
                return response()->json($response);
            }
        }
    	$cart->add($product, $id, $quantily);
    	$request->session()->put('cart',$cart);
        $totalQty = $cart->totalQty;
        $totalPrice = $cart->totalPrice;
        if($cart->items[$id]['item']['promotion_price'] == 0){
            $subtotal = $cart->items[$id]['qty'] * $cart->items[$id]['item']['unit_price'];
        }else{
            $subtotal = $cart->items[$id]['qty'] * $cart->items[$id]['item']['promotion_price'];
        }
        $response = array(
                'totalPrice' => $totalPrice,
                'totalQty' => $totalQty,
                'subtotal' => $subtotal,
                'status' => $status
            );
        return response()->json($response); 
    	// return redirect()->back();
    }

    public function getCart(){
        if(Session::has('cart')){
            return view('page.shopping_cart');
        }else{
            return redirect()->route('getIndex')->with(['flash_level' => 'info','flash_message' => 'Chưa có sản phẩm nào trong giỏ hàng']);
        }
    }

    public function getDelCart($id){
    	$oldCart = Session('cart') ? Session::get('cart') : null;
    	$cart = new Cart($oldCart);
    	$cart->removeItem($id);
    	if(count($cart->items)>0){
    		Session::put('cart',$cart);
    	}else{
    		Session::forget('cart');
    	}
        $totalQty = $cart->totalQty;
        $totalPrice = $cart->totalPrice;
        $status = true;
        if($totalPrice == 0){
            $status = false;
        }
    	$response = array(
                'totalPrice' => $totalPrice,
                'totalQty' => $totalQty,
                'status' => $status
            );
        return response()->json($response); 
    }

    public function getDelAllCart(){
        Session::forget('cart');
        return redirect()->route('getIndex')->with(['flash_level' => 'success','flash_message' => 'Bạn đã xóa giỏ hàng']);
    }

    public function getCheckOut(){
        if(!Auth::check()){
            return redirect()->route('getLogin')->with(['flash_level' => 'error','flash_message' => 'Vui lòng đăng nhập để đặt hàng. Cảm ơn!']);
        }else{
            return view('page.checkout');
        }
    }

    public function postCheckOut(CheckoutRequest $request){
    	$cart = Session::get('cart');
    	$customer = new Customer();
    	$customer->name = $request->name;
    	$customer->gender = $request->gender;
    	$customer->email = $request->email;
    	$customer->address = $request->address;
    	$customer->phone = $request->phone;
    	$customer->note = $request->notes;
    	$customer->save();
    	$bill = new Bill();
    	$bill->customer_id = $customer->id;
        $bill->user_id = Auth::user()->id;
    	$bill->date_order = new DateTime();
    	$bill->total = $cart->totalPrice;
    	$bill->payment = $request->payment_method; 
    	$bill->note = $request->notes;
    	$bill->save();
    	foreach($cart->items as $key => $val){
    		$bill_detail = new BillDetail();
    		$bill_detail->bill_id = $bill->id;
    		$bill_detail->product_id = $key;
    		$bill_detail->quantily = $val['qty'];
    		$bill_detail->unit_price = $val['price'] / $val['qty'];
    		$bill_detail->save();
    	}
    	Session::forget('cart');
    	return redirect()->route('getIndex')->with(['flash_level' => 'success','flash_message' => 'Bạn đã đặt hàng thành công. Vui lòng xem đơn đặt hàng trong hồ sơ của bạn. Xin cảm ơn!']);
    }

    public function getLogin(){
        if(!Auth::check()){
            return view('page.login');
        }else{
            return redirect()->route('getIndex');
        }
    }

    public function postLogin(LoginRequest $request){
        $data = array(
                'email' => $request->txtEmail,
                'password' => $request->txtPassword
            );
        if(Auth::attempt($data)){
            return redirect()->route('getIndex')->with(['flash_level' => 'success','flash_message' => 'Đăng nhập thành công']);
        }else{
            return redirect()->back()->with(['flash_level' => 'error','flash_message' => 'Lỗi email hoặc password']);
        }
    }

    public function getSignup(){
        if(!Auth::check()){
            return view('page.signup');
        }else{
            return redirect()->route('getIndex');
        }
    }

    public function postSignup(SignUpRequest $request){
        $user = new User();
        $user->full_name = $request->txtFullName;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtPass);
        $user->facebook_id = null;
        $user->created_at = new DateTime();
        $user->save();
        Auth::login($user);
        return redirect()->route('getIndex')->with(['flash_level' => 'success','flash_message' => 'Bạn đã đăng ký thành công']);
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('getIndex')->with(['flash_level' => 'success','flash_message' => 'Đăng xuất thành công']);
    }

    public function getSearch(Request $request){
        $slide = Slide::all();
        $order = $request->searchOrder;
        $key = $request->key;
        switch  ($order) {
            case 2: 
                $product = Product::where('name','like','%'.$key.'%')->orderBy('unit_price',"DESC")->paginate(12);
                break;
            case 3: 
                $product = Product::where('name','like','%'.$key.'%')->orderBy('unit_price',"ASC")->paginate(12);
                break;
            case 4: 
                $product = Product::where('name','like','%'.$key.'%')->orderBy('avg_rate',"DESC")->paginate(12);
                break;
            case 5: 
                $product = Product::where('name','like','%'.$key.'%')->orderBy('avg_rate',"ASC")->paginate(12);
                break;
            default:
                $product = Product::where('name','like','%'.$key.'%')->paginate(12);
        }
        return view('page.search',['product'=>$product, 'slide'=>$slide]);
    }

    public function getRateProduct(Request $request, $id){
        $status = 1;
        $product = Product::find($id);
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $user_rate = Rate::where([['user_id',$user_id],['product_id',$product->id]])->count();
            if($user_rate == 0){
                $status = 1;
                $rate = new Rate();
                $rate->point = $request->point;
                $rate->user_id = Auth::user()->id;
                $rate->product_id = $id;
                $rate->created_at = new DateTime();
                $rate->save();
                $count_rate = Rate::where('product_id',$id)->count();
                $sum_rate = Rate::where('product_id',$id)->sum('point');
                $total = $sum_rate / $count_rate;
                $product->avg_rate = $total;
                $product->save();
                $reponse= array(
                        'avg_rate' => $total,
                        'status' => $status
                    ); 
                return response()->json($reponse);
            }else{
                $status = 2;
                $total = $product->avg_rate;
                $reponse= array(
                        'avg_rate' => $total,
                        'status' => $status
                    ); 
                return response()->json($reponse);
            }
            
        }else{
            $status = 3;
            $reponse= array(
                    'status' => $status
                ); 
            return response()->json($reponse);
        }
    }

    public function getProfile(){
        if(Auth::check()){
            return view('page.profile');
        }else{
            return redirect()->route('getIndex');
        }
        
    }

    public function getEditProfile(){
        if(Auth::check()){
            return view('page.edit_profile');
        }else{
            return redirect()->route('getIndex');
        }
    }

    public function postEditProfile(Request $request){
        $user = User::find(Auth::user()->id);
        if($request->txtPass){
            $this->validate($request,
                [
                    'txtRepass' => 'same:txtPass'
                ],
                [
                    'txtRepass.same' => "Xác nhận mật khẩu không đúng."
                ]
            );
            $user->password = bcrypt($request->txtPass);
        }
        $user->full_name = $request->txtFullName;
        $user->email = $request->txtEmail;
        $user->updated_at = new DateTime();
        $user->save();
        return redirect()->route('getProfile')->with(['flash_level' => 'success','flash_message' => 'Cập nhập hồ sơ thành công']);
    }

    public function getHistoryOrder(){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $data = Bill::where('user_id',$user_id)->get();
            return view('page.history_order',['data'=>$data]);
        }else{
            return redirect()->route('getIndex');
        }
    }

    public function getDetaiHistoryOrder($id){
        if(Auth::check()){
            $data = BillDetail::with('bill')->with('product')->where('bill_id',$id)->get();
            return view('page.detai_history_order',['data'=>$data]);
        }else{
            return redirect()->route('getIndex');
        }
    }

    public function postComment(Request $request){
        if ($request->ajax()) {
            $comment = new Comment;
            $comment->content = $request->cotnent;
            $comment->user_id  = Auth::id();
            $comment->product_id = $request->product_id;
            $comment->parent_id = 0;
            $comment->created_at = new DateTime;
            $create_at = $comment->created_at->diffForHumans();
            $comment->save();
            $reponse = array(
                    'create_at' => $create_at,
                    'full_name' => Auth::user()->full_name,
                    'content' => $request->cotnent,
                    'id'=> $comment->id
                );
            return response()->json($reponse);
        }
    }

    public function postCommentReply(Request $request){
        if ($request->ajax()) {
            $comment = new Comment;
            $comment->content = $request->content;
            $comment->user_id  = Auth::id();
            $comment->product_id = $request->product_id;
            $comment->parent_id = $request->parent_id;;
            $comment->created_at = new DateTime;
            $create_at = $comment->created_at->diffForHumans();
            $comment->save();
            $reponse = array(
                    'create_at' => $create_at,
                    'full_name' => Auth::user()->full_name,
                    'id' => $comment->id
                );
            return response()->json($reponse);
        }
    }

    public function getDelComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        $comment_child = Comment::where('parent_id', $id)->get();
        foreach($comment_child as $cmt){
            $cmt->delete();
        }
        return response()->json();
    }

    public function getDelReply($id){
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json();
    }

    public function getUpdateComment(Request $request, $id){
        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->save();
        return response()->json();
    }
}
