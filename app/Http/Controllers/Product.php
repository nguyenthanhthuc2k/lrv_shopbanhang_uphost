<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class Product extends Controller
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
     public function add_product(){
        $this->AuthLogin();
        $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
    	return view('admin.add-product')->with('category_product',$category_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
    	//lây tt bảng tbl_product
    	$all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
    	$manager_product = view('admin.all-product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    //Thêm mới sản phẩm
    public function save_product(Request $request){
        $this->AuthLogin();
        if( $request->product_qty==''|| $request->product_name==''||$request->product_price==''||$request->product_content==''||$request->product_desc==''||$request->product_category==''||$request->product_brand==''||$request->product_status==''){
            Session::put('message','Vui lòng nhập đầy đủ thông tin');
            return Redirect::to('add-product');
        }
        elseif($request->file('product_image')== null){
            Session::put('message','Vui lòng chọn hình ảnh');
            return Redirect::to('add-product');
        }
        else {
            $data = array();
            $data['product_name'] = $request->product_name;
            $data['product_qty'] = $request->product_qty;
            $data['product_price'] = $request->product_price;
            $data['product_meta_keywords'] = $request->product_meta_keywords;
            $data['product_content'] = $request->product_content;
            $data['product_desc'] = $request->product_desc;
            $data['category_id'] = $request->product_category;
            $data['brand_id'] = $request->product_brand;
            $data['product_status'] = $request->product_status;
            // echo $data;
            $get_image = $request->file('product_image');
            if($get_image){
                // lấy tên hình ảnh ban đầu đầy đủ
                $get_name_image = $get_image->getClientOriginalName(); 
                //lấy đuôi file ( phần mở rộng)
                $duoi_hinh = $get_image->getClientOriginalExtension();
                //lấy tên hình trước phần mở rộng
                $ten_hinh = current(explode('.', $get_name_image));
                //tên hình ảnh sau khi update
                $new_name_image = 'dien-thoai-'.$ten_hinh.'-'.rand(0,99).'.'.$duoi_hinh;
                //  cho hình vào thu mục chứa hình ảnh
                $get_image->move('public/upload/product',$new_name_image);
                //truy vấn lưu tên vào database
                $data['product_image'] = $new_name_image;
                // DB::table('tbl_product')->insert($data);
            }
            // lưu thông tin sản phẩm
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm thành công');
            return Redirect::to('add-product');
        }
    }
    //update status brand product
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Update sản phẩm ẩn thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
         DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Update sản phẩm hiện thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit-product')->with('edit_product',$edit_product)->with('category_product',$category_product)->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        if($request->product_qty==''|| $request->product_name==''||$request->product_price==''||$request->product_content==''||$request->product_desc==''||$request->product_category==''||$request->product_brand==''||$request->product_status==''){
            Session::put('message','Vui lòng nhập đầy đủ thông tin');
            return Redirect::to('edit-product/'.$product_id);
        }
        else {
            $data = array();
            $data['product_qty'] = $request->product_qty;
            $data['product_name'] = $request->product_name;
            $data['product_price'] = $request->product_price;
            $data['product_content'] = $request->product_content;
            $data['product_meta_keywords'] = $request->product_meta_keywords;
            $data['product_desc'] = $request->product_desc;
            $data['category_id'] = $request->product_category;
            $data['brand_id'] = $request->product_brand;
            $data['product_status'] = $request->product_status; 
            // echo $data;
            $get_image = $request->file('product_image');
            if($get_image){
                // lấy tên hình ảnh ban đầu đầy đủ
                $get_name_image = $get_image->getClientOriginalName(); 
                //lấy đuôi file ( phần mở rộng)
                $duoi_hinh = $get_image->getClientOriginalExtension();
                //lấy tên hình trước phần mở rộng
                $ten_hinh = current(explode('.', $get_name_image));
                //tên hình ảnh sau khi update
                $new_name_image = 'dien-thoai-'.$ten_hinh.'-'.rand(0,99).'.'.$duoi_hinh;
                //  cho hình vào thu mục chứa hình ảnh
                $get_image->move('public/upload/product',$new_name_image);
                //truy vấn lưu tên vào database
                $data['product_image'] = $new_name_image;
                Session::put('message','Update sản phẩm thành công');
                DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            }
            // lưu thông tin sản phẩm
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Update sản phẩm thành công');
            return Redirect::to('all-product');
        }
    }
    public function delete_product($product_id){
        $this->AuthLogin();
       DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-product');
    }

    //end admin
    public function details_product(Request $request ,$product_id){
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product_detail = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('product_id',$product_id)->get();

        //lấy id danh mục sp cùng loại
        foreach($product_detail as $key => $lay_category_id){
            $category_id = $lay_category_id->category_id;
        }
        // lấy sp cùng danh muc theo id
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->limit(3)->get();
        //seo
        foreach($product_detail as $key => $v) {
            $meta_desc = $v->product_desc;
            $meta_keywords = $v->product_meta_keywords;
            $meta_title = $v->product_name;
            $url_canonical = $request->url();
        }

        return view('pages/product/details_product')->with('category',$category_product)->with('brand',$brand_product)->with('product_detail',$product_detail)->with('related_product',$related_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('meta_desc',$meta_desc)->with('url_canonical',$url_canonical);
    }
}

