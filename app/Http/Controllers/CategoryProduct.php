<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
    	return view('admin.add-category-product');
    }
    public function all_category_product(){
        $this->AuthLogin();
    	//lây tt bảng tbl_category_product
    	$all_category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    	$manager_category_product = view('admin.all-category-product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->cat_product_name;
    	$data['category_desc'] = $request->cat_product_desc;
    	$data['category_status'] = $request->cat_product_status;
        $data['category_meta_keywords'] = $request->cat_product_keywords;
    	
    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Thêm thành công');
    	return Redirect::to('add-category-product');
    }
    //update status category product
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Update danh mục sản phẩm ẩn thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
         DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Update danh mục sản phẩm hiện thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit-category-product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request ,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->cat_product_name;
        $data['category_desc'] = $request->cat_product_desc;
        $data['category_meta_keywords'] = $request->cat_product_keywords;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Update thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
       DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-category-product');
    }


    //end admin page
    public function show_category_home(Request $request ,$category_id){
        // seo
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $category_name = DB::table('tbl_category_product')->where('category_id',$category_id)->limit(1)->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();
        
        foreach($category_name as $key => $v) {
            $meta_desc = $v->category_desc;
            $meta_keywords = $v->category_meta_keywords;
            $meta_title = $v->category_name;
            $url_canonical = $request->url();
        }
        return view('pages.category.show_category')->with('category',$category_product)->with('brand',$brand_product)->with('category_name',$category_name)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('meta_desc',$meta_desc)->with('url_canonical',$url_canonical)->with('category_by_id',$category_by_id);
    }
}
