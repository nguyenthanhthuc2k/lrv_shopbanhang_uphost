<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function index(Request $Request){
        // seo
        $meta_desc="Chuyên cung cấp ac game ngọc rồng, liên minh, liên quân,.. giá rẻ uy tín nhất thị trường";
        $meta_keywords ="Shop ac ngọc rồng, ac ngọc rồng giá rẽ, shop ngọc rồng uy tín";
        $meta_title = "Trang chủ shop bán ac ngọc rồng uy tín chất lượng";
        $url_canonical = $Request->url();

    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
         $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
    	return view('pages.home')->with('category',$category_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('meta_desc',$meta_desc);
        //cach2
        //return view('pages.home')->with(compact('category_product','brand_product'));
    }

    public function search(Request $Request){
    	$keysword = $Request->keysword_submit;
        $meta_desc = 'Tìm kiếm';
        $meta_keywords = $keysword ;
        $meta_title = 'Tìm kiếm';
        $url_canonical = $Request->url();
    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
         $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keysword.'%')->get();
    	return view('pages.product.search')->with('category',$category_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('meta_desc',$meta_desc);
    }
}
