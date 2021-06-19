<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/clear-cache'),function(){
	$exitCode = Artisan::call('cache:clear');
}
//user
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');

//danh muc san pham
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','Product@details_product');
//
 
//send mail
Route::get('/send-mail','MailController@send_mail');
//Login facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');

//Login  google
Route::get('/login-google','AdminController@login_google');
Route::get('/google/callback','AdminController@callback_google');

//admin

Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');





//Category Product 

Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');
Route::post('/save_category_product','CategoryProduct@save_category_product');
Route::post('/update_category_product/{category_product_id}','CategoryProduct@update_category_product');
		//update status Category Product
Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');

//Brand Product 

Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');
Route::post('/save_brand_product','BrandProduct@save_brand_product');
Route::post('/update_brand_product/{brand_product_id}','BrandProduct@update_brand_product');
		//update status brand Product
Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');


//Product 

Route::get('/add-product','Product@add_product');
Route::get('/all-product','Product@all_product');
Route::post('/save_product','Product@save_product');
Route::post('/update_product/{product_id}','Product@update_product');
		//update status Product
Route::get('/unactive-product/{product_id}','Product@unactive_product');
Route::get('/active-product/{product_id}','Product@active_product');
Route::get('/edit-product/{product_id}','Product@edit_product');
Route::get('/delete-product/{product_id}','Product@delete_product');

// Cart
Route::post('/save-cart','CartController@save_cart');
Route::post('/update-cart-qty','CartController@update_cart_qty');
Route::post('/update-cart-ajax','CartController@update_cart_ajax');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/show-cart','CartController@show_cart');
Route::get('/show-cart-ajax','CartController@show_cart_ajax');
Route::get('/delete-product-cart/{rowId}','CartController@delete_product_cart');
Route::get('/delete-product-cart-ajax/{sessionId}','CartController@delete_product_cart_ajax');
Route::get('/delete-all-product-cart','CartController@delete_all_product_cart');

//coupon 
//user
Route::post('/check-coupon','CartController@check_coupon');
//admin
Route::get('/add-coupon','CouponController@add_coupon');
Route::get('/unset-coupon','CouponController@unset_coupon');
Route::get('/all-coupon','CouponController@all_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::post('/save-insert-coupon','CouponController@save_insert_coupon');


//check out

Route::post('/confirm-order-ajax','CheckoutController@confirm_order_ajax');
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-checkout-customer','CheckoutController@login_checkout_customer');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::get('/logout-checkout','CheckoutController@logout_checkout');

 //quan li don hang

Route::post('/update-order-status','OrderController@update_order_status');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/print-order/{order_code}','OrderController@print_order');

// Route::get('/manage-order','CheckoutController@manage_order');
// Route::get('/view-order/{orderId}','CheckoutController@view_order');


//delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');
Route::post('/calculator-delivery','DeliveryController@calculator_delivery');
