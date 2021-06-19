<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Coupon; // link sang model
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CouponController extends Controller
{
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon){
            session::forget('coupon');
            return Redirect()->back()->with('message','Xóa mã khuyến mãi thành công !');
        }
        else{
            return Redirect()->back()->with('error','Xóa mã khuyến mãi thất bại !');
        }
    }
    public function delete_coupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-coupon');
    }
	public function add_coupon(Request $Request){
		$this->AuthLogin();
		return view('admin.coupon.add_coupon');
	}
    public function all_coupon(){
        $this->AuthLogin();
        $coupon = Coupon::orderby('coupon_id','desc')->get();
        return view('admin.coupon.all_coupon')->with(compact('coupon'));
    }
	public function save_insert_coupon(Request $Request){
        $this->AuthLogin();
		$data = $Request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();
        Session::put('message','Thêm thành công');
        return Redirect::to('add-coupon');
	}
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
             return Redirect::to('admin')->send();
        }
    } 

}
