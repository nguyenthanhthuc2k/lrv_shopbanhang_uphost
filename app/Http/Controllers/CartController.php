<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Http\Requests;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
session_start();
class CartController extends Controller
{
    public function check_coupon(Request $Request){
        $data = $Request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if ($count_coupon >0 ) {
                $coupon_session = Session::get('coupon');
                if($coupon_session){
                    $is_avaiable = 0;
                    if($is_avaiable==0)
                        $cou[] = array(
                            'coupon_code' =>$coupon->coupon_code,
                            'coupon_condition' =>$coupon->coupon_condition,
                            'coupon_number' =>$coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                }
                else{
                    $cou[] = array(
                            'coupon_code' =>$coupon->coupon_code,
                            'coupon_condition' =>$coupon->coupon_condition,
                            'coupon_number' =>$coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                }
                Session::save();
                return Redirect()->back()->with('message','Thêm mã giảm giá thành công !');
            }
        }
        else{
            return Redirect()->back()->with('error','Mã giảm giá không đúng');
        }
    }
    public function delete_all_product_cart(){
        $cart = Session::get('cart');
        session::forget('cart');
        return Redirect()->back()->with('message','Xóa sản phẩm thành công !');
    }
    public function delete_product_cart_ajax($sessionId){
        $cart = session::get('cart');
        if($cart==true){
            foreach ($cart as $key => $val) {
            if($sessionId == $val['session_id']){
                unset($cart[$key]);
            }
        }
        session::put('cart',$cart);
        return Redirect()->back()->with('message','Xóa sản phẩm thành công !');
        }
        else{
            return Redirect()->back()->with('error','Xóa sản phẩm thất bại !');
        }
    }
    public function update_cart_ajax(Request $Request){
        $data = $Request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty)
            {
                foreach ($cart as $session => $val) {
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message','Cập nhật giỏ hàng thành công');
        }
        else{
            return Redirect()->back()->with('error','Cập nhật giỏ hàng thất bại');
        }
    }
    public function show_cart_ajax(Request $Request){
        $meta_desc = 'Giỏ hàng của bạn';
        $meta_keywords = '';
        $meta_title = 'Giỏ hàng của bạn';
        $url_canonical = $Request->url();
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart_ajax')->with('category',$category_product)->with('brand',$brand_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('meta_desc',$meta_desc);
    }
    public function add_cart_ajax(Request $Request){
        $data = $Request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart == true){
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if($val['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key] = array(
                    'session_id'=> $session_id,
                    'product_name'=> $data['cart_product_name'],
                    'product_id'=>  $data['cart_product_id'],
                    'product_image'=>  $data['cart_product_image'],
                    'product_qty'=>  $data['cart_product_qty']  + $val['product_qty'] ,
                    'product_price'=>  $data['cart_product_price'],
                     );
                     Session::put('cart',$cart);
                    }
            }
            if($is_avaiable == 0){
                 $cart[] = array(
                'session_id'=> $session_id,
                'product_name'=> $data['cart_product_name'],
                'product_id'=>  $data['cart_product_id'],
                'product_image'=>  $data['cart_product_image'],
                'product_qty'=>  $data['cart_product_qty'] ,
                'product_price'=>  $data['cart_product_price'],
                 );
                 Session::put('cart',$cart);
            }
        }
        else  {
            $cart[] = array(
                'session_id'=> $session_id,
                'product_name'=> $data['cart_product_name'],
                'product_id'=>  $data['cart_product_id'],
                'product_image'=>  $data['cart_product_image'],
                'product_qty'=>  $data['cart_product_qty'],
                'product_price'=>  $data['cart_product_price'],
             );
            Session::put('cart',$cart);
        }
        Session::save();

    }
    //save-cart
    public function save_cart(Request $request){
    	$product_id =  $request->product_id_hidden;
    	$quanlity = $request->qty;

    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	$product_info = DB::table('tbl_product')->where('tbl_product.product_id',$product_id)->first();
    	//test add cart
    	// Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    	//Xóa sp trong cart
    	// Cart::destroy();
    	//các giá trị mặc đinh của cart
    	// lệnh cài cart composer require bumbummen99/shoppingcart laravel trên 5.8
    	$data['id'] = $product_id;
    	$data['qty'] = $quanlity;
    	$data['name'] = $product_info->product_name;
		$data['price'] = $product_info->product_price;
    	$data['weight'] = $product_info->product_price;
    	$data['options']['image'] = $product_info->product_image;
    	// them sp vào cart
    	Cart::add($data);
    	// goi route show-cart
    	return Redirect::to('/show-cart');

    }
    //ham show-cart
    public function show_cart(Request $Request){
        $meta_desc = 'Giỏ hàng của bạn';
        $meta_keywords = '';
        $meta_title = 'Giỏ hàng của bạn';
        $url_canonical = $Request->url();
    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages.cart.show_cart')->with('category',$category_product)->with('brand',$brand_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('meta_desc',$meta_desc);
    }
    public function delete_product_cart($rowId){
    	Cart::update($rowId,0);
    	return Redirect::to('/show-cart');
    }
    public function update_cart_qty(Request $request){
    	$rowId = $request->rowId_product;
    	$qty = $request->quantity;
    	Cart::update($rowId,$qty);
    	return Redirect::to('/show-cart');
    }
}
