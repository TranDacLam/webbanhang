<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'PageController@getIndex')->name('getIndex');
Route::get('loai-san-pham/{id}/{alias}', 'PageController@getCategory')->name('getCategory')->where('id', '[0-9]+');
Route::get('chi-tiet-san-pham/{id}/{alias}', 'PageController@getDetail')->name('getDetail')->where('id', '[0-9]+');
Route::get('lien-he', 'PageController@getContact')->name('getContact');
Route::get('gioi-thieu', 'PageController@getAbout')->name('getAbout');
Route::get('add-to-cart/{id}', 'PageController@getAddToCart')->name('getAddToCart')->where('id', '[0-9]+');
Route::get('gio-hang', 'PageController@getCart')->name('getCart');
Route::get('del-all-cart', 'PageController@getDelAllCart')->name('getDelAllCart');
Route::get('del-cart/{id}', 'PageController@getDelCart')->name('getDelCart')->where('id', '[0-9]+');
Route::get('dat-hang', 'PageController@getCheckOut')->name('getCheckOut');
Route::post('dat-hang', 'PageController@postCheckOut')->name('postCheckOut');
Route::get('dang-nhap', 'PageController@getLogin')->name('getLogin');
Route::post('dang-nhap', 'PageController@postLogin')->name('postLogin');
Route::get('dang-ky', 'PageController@getSignup')->name('getSignup');
Route::post('dang-ky', 'PageController@postSignup')->name('postSignup');
Route::get('dang-xuat', 'PageController@getLogout')->name('getLogout');
Route::get('search', 'PageController@getSearch')->name('getSearch');
Route::get('rating/{id}', 'PageController@getRateProduct')->name('getRateProduct')->where('id', '[0-9]+');
Route::get('ho-so', 'PageController@getProfile')->name('getProfile');
Route::get('chinh-sua-ho-so', 'PageController@getEditProfile')->name('getEditProfile');
Route::post('chinh-sua-ho-so', 'PageController@postEditProfile')->name('postEditProfile');
Route::get('lịch-su-dat-hang', 'PageController@getHistoryOrder')->name('getHistoryOrder');
Route::get('lịch-su-chi-tiet-dat-hang/{id}', 'PageController@getDetaiHistoryOrder')->name('getDetaiHistoryOrder')->where('id', '[0-9]+');
Route::post('binh-luan', 'PageController@postComment')->name('postComment');
Route::post('tra-loi-binh-luan', 'PageController@postCommentReply')->name('postCommentReply');
Route::get('del-binh-luan/{id}', 'PageController@getDelComment')->name('getDelComment')->where('id', '[0-9]+');
Route::get('del-tra-loi/{id}', 'PageController@getDelReply')->name('getDelReply')->where('id', '[0-9]+');
Route::get('cap-nhap-binh-luan/{id}', 'PageController@getUpdateComment')->name('getUpdateComment')->where('id', '[0-9]+');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => ['auth','admin']], function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
    	Route::get('/',function (){
    		return view('admin.home');
    	});
    	Route::group(['prefix' => 'the-loai'], function(){
    		Route::get('list', 'CategoryController@getListCate')->name('getListCate');
    		Route::get('add', 'CategoryController@getAddCate')->name('getAddCate');
    		Route::post('add', 'CategoryController@postAddCate')->name('postAddCate');
    		Route::get('del/{id}', 'CategoryController@getDelCate')->name('getDelCate')->where('id', '[0-9]+');
    		Route::get('edit/{id}', 'CategoryController@getEditCate')->name('getEditCate')->where('id', '[0-9]+');
    		Route::post('edit/{id}', 'CategoryController@postEditCate')->name('postEditCate')->where('id', '[0-9]+');
    	});

    	Route::group(['prefix' => 'thanh-vien'], function(){
    		Route::get('add', 'UserController@getAddUser')->name('getAddUser');
    		Route::post('add', 'UserController@postAddUser')->name('postAddUser');
    		Route::get('list', 'UserController@getListUser')->name('getListUser');
    		Route::get('del/{id}', 'UserController@getDelUser')->name('getDelUser')->where('id', '[0-9]+');
    		Route::get('edit/{id}', 'UserController@getEditUser')->name('getEditUser')->where('id', '[0-9]+');
    		Route::post('edit/{id}', 'UserController@postEditUser')->name('postEditUser')->where('id', '[0-9]+');
    	});

    	Route::group(['prefix' => 'san-pham'], function(){
    		Route::get('add', 'ProductController@getAddProduct')->name('getAddProduct');
    		Route::post('add', 'ProductController@postAddProduct')->name('postAddProduct');
    		Route::get('list', 'ProductController@getListProduct')->name('getListProduct');
    		Route::get('del/{id}', 'ProductController@getDelProduct')->name('getDelProduct')->where('id', '[0-9]+');
    		Route::get('edit/{id}', 'ProductController@getEditProduct')->name('getEditProduct')->where('id', '[0-9]+');
    		Route::post('edit/{id}', 'ProductController@postEditProduct')->name('postEditProduct')->where('id', '[0-9]+');
    	});

    	Route::group(['prefix' => 'dat-hang'], function(){
    		Route::get('danh-sach-dat-hang', 'OrderController@getIndexOrder')->name('getIndexOrder');
    		Route::get('chi-tiet-dat-hang/{id}', 'OrderController@getDetailOrder')->name('getDetailOrder');
    		Route::get('del/{id}', 'OrderController@getDelOrder')->name('getDelOrder')->where('id', '[0-9]+');
    	});
   	});
});