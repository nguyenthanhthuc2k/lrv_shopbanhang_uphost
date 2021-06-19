<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;

// link sang model 
use App\Models\City; 
use App\Models\Wards; 
use App\Models\Province; 
use App\Models\Feeship; 
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
             return Redirect::to('admin')->send();
        }
    } 
    public function confirm_order_ajax(Request $Request){
         $data = $Request->all();
         $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email= $data['shipping_email'];
         $shipping->shipping_notes= $data['shipping_notes'];
         $shipping->shipping_phone= $data['shipping_phone'];
         $shipping->shipping_address= $data['shipping_address'];
         $shipping->shipping_method= $data['shipping_method'];
         $shipping->save();

         $shipping_id = $shipping->shipping_id;
         $check_code = substr(md5(microtime()),rand(0,26),5);
         $order = new Order();
         $order->customer_id = Session::get('customer_id');
         $order->order_code = $check_code;
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         date_default_timezone_set('Asia/Ho_Chi_Minh');
          $order->created_at = now();
         $order->save();

         
         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart) {
                $order_detail = new OrderDetail();
                $order_detail->order_code = $check_code;
                $order_detail->product_id=$cart['product_id'];
                $order_detail->product_name=$cart['product_name'];
                $order_detail->product_price=$cart['product_price'];
                $order_detail->product_sales_quantity=$cart['product_qty'];
                $order_detail->product_coupon=$data['shipping_cou'];
                $order_detail->product_feeship=$data['shipping_fee'];
                $order_detail->save();
            }
         }
        Session::forget('cart');
        Session::forget('fee');
        Session::forget('coupon');
    }
    public function select_delivery_home(Request $Request){
        $data = $Request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option value="">---Chọn Quận/Huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';
                }
            }else{
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option value="">---Phường/Xã/Thị trấn---</option>';
                foreach($select_wards as $key => $ward){
                    $output.= '<option value="'.$ward->xaid.'">'.$ward->name_xa.'</option>';
                }
            }
            echo $output;
        }
    }
    public function login_checkout(Request $Request){
        $meta_desc = 'Đăng nhập thanh toản giỏ hàng của bạn';
        $meta_keywords = '';
        $meta_title = 'Đăng nhập';
        $url_canonical = $Request->url();
    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

    	return view('pages.checkout.login-checkout')->with('category',$category_product)->with('brand',$brand_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('meta_desc',$meta_desc);
    }
    //dang ky thanh vien
    public function add_customer(Request $Request){
    	$data = array();
    	$data['customer_name'] = $Request->customer_name;
    	$data['customer_email'] = $Request->customer_email;
    	$data['customer_password'] = md5($Request->customer_password);
    	$data['customer_phone'] = $Request->customer_phone;
    	$customer_id = DB::table('tbl_customer')->insertGetId($data);
    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$Request->customer_name);
    	return Redirect::to('/checkout');
    }
    //dat hang
    public function order_place(Request $Request){
        
         $meta_desc = 'Giỏ hàng của bạn';
        $meta_keywords = '';
        $meta_title = 'Giỏ hàng của bạn';
        $url_canonical = $Request->url();
        //indert payment_method
        $payment_data = array();
        $payment_data['payment_method'] = $Request->payment_option;
        $payment_data['payment_status'] = '0';
        $payment_id = DB::table('tbl_payment')->insertGetId($payment_data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_status'] = '0';
        $order_data['order_total'] = Cart::total();
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order details
        $content = Cart::content();
        foreach($content as $key => $v){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v->id;
            $order_d_data['product_name'] =  $v->name;
            $order_d_data['product_price'] =  $v->price;
            $order_d_data['product_sales_quantity'] = $v->qty;
            $result = DB::table('tbl_order_details')->insert($order_d_data);
        }

        if($payment_data['payment_method']== 1 ){
            echo 'Trả bằng ATM';
        }
        elseif ($payment_data['payment_method']== 2 ) {
            Cart::destroy();
            $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.checkout.handcash')->with('category',$category_product)->with('brand',$brand_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('meta_desc',$meta_desc);
        }
        else{
            echo 'Thẻ ghi nợ';
        }
        //return Redirect::to('/');
    }
    public function checkout(Request $Request){
        $meta_desc = 'Thanh toản giỏ hàng của bạn';
        $meta_keywords = '';
        $meta_title = 'Thanh toán';
        $url_canonical = $Request->url();
        $city = City::orderby('matp','ASC')->get();
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

    	return view('pages.checkout.show-checkout')->with('category',$category_product)->with('brand',$brand_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('meta_desc',$meta_desc)->with('city',$city);
    }
    //thong tin giao hang
    public function save_checkout_customer(Request $Request){
        $data = array();
        $data['customer_id'] = Session::get('customer_id');
        $data['shipping_name'] = $Request->shipping_name;
        $data['shipping_email'] = $Request->shipping_email;
        $data['shipping_phone'] = $Request->shipping_phone;
        $data['shipping_notes'] = $Request->shipping_notes;
        $data['shipping_address'] = $Request->shipping_address;
        $shipping_id = DB::table('tbl_shipping')->insertgetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }
    public function payment(Request $Request){
         $meta_desc = 'Giỏ hàng của bạn';
        $meta_keywords = '';
        $meta_title = 'Giỏ hàng của bạn';
        $url_canonical = $Request->url();
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.checkout.payment')->with('category',$category_product)->with('brand',$brand_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('meta_desc',$meta_desc);
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_checkout_customer(Request $Request){
        $email = $Request->customer_email;
        $password = md5($Request->customer_password);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }
        else {
            return Redirect::to('/login_checkout');
        }
    }


    //admin
    //manage_order
    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manage-order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_details.product_id')
        ->where('tbl_order.order_id','=',$orderId)
        ->select('tbl_order.*','tbl_order_details.*','tbl_product.product_image')->get();

        $shipping_by_id = DB::table('tbl_order')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->where('tbl_order.order_id','=',$orderId)
        ->select('tbl_shipping.*')->get();

        $customer_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->where('tbl_order.order_id','=',$orderId)
        ->select('tbl_customer.*')->get();


        $manager_order_by_id = view('admin.view-order')->with('order_by_id',$order_by_id)->with('shipping_by_id',$shipping_by_id)->with('customer_by_id',$customer_by_id);

        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
    }
}
