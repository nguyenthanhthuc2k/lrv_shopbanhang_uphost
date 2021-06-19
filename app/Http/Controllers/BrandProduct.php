<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand; // link sang model brand
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

// brand::ham(); -> static trong hdt
class BrandProduct extends Controller
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
     public function add_brand_product(){
        $this->AuthLogin();
    	return view('admin.add-brand-product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
    	//lây tt bảng tbl_brand_product

        //cach cu, k models
    	// $all_brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        //cach co models k phan trang
        // $all_brand_product = Brand::orderBy('brand_id','desc')->take(10)->get();

        //cach co models co phan trang
        $all_brand_product = Brand::orderBy('brand_id','desc')->paginate(10);


    	$manager_brand_product = view('admin.all-brand-product')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        //dung models
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_meta_keywords = $data['brand_meta_keywords'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        //end models

        //van chay dc nhung k can modal
    	// $data = array();
    	// $data['brand_name'] = $request->brand_product_name;
    	// $data['brand_desc'] = $request->brand_product_desc;
    	// $data['brand_status'] = $request->brand_product_status;
    	// DB::table('tbl_brand_product')->insert($data);


    	Session::put('message','Thêm thành công');
    	return Redirect::to('add-brand-product');
    }
    //update status brand product
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Update thương hiệu sản phẩm ẩn thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
         DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Update thương hiệu sản phẩm hiện thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();

        //cach cu
        // $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();

        //cach moi //find là làm dk giống where nhưng k cần foreach bên  trang edit
        $edit_brand_product = Brand::find($brand_product_id);
        //hoac co the dung foreach
        //$edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit-brand-product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();

        //cach cu
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);

        //cach moi models
        $data = $request->all();
        $brand =  Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_meta_keywords = $data['brand_meta_keywords'];
        $brand->save();
        
        Session::put('message','Update thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
       DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-brand-product');
    }

   //end admin page
    public function show_brand_home(Request $request,$brand_id){
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')->where('tbl_product.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_id',$brand_id)->limit(1)->get();

         foreach($brand_name as $key => $v) {
            $meta_desc = $v->brand_desc;
            $meta_keywords = $v->brand_meta_keywords;
            $meta_title = $v->brand_name;
            $url_canonical = $request->url();
        }
        return view('pages.brand.show_brand')->with('category',$category_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('meta_desc',$meta_desc)->with('url_canonical',$url_canonical);
    }
}  
