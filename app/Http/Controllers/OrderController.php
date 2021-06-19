<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Feeship; 
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Coupon;
use DB;
use PDF;
use Illuminate\Support\Facades\Redirect;
class OrderController extends Controller
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
    public function update_order_qty(Request $Request){
    	$data = $Request->all();
    	$order = OrderDetail::where('order_code',$data['order_code'])->where('product_id',$data['order_product_id'])->first();
		if($order->product_id == $data['order_product_id']){
			$order->product_sales_quantity = $data['order_qty_id'];
			$order->save();
		}
    }
    public function update_order_status(Request $Request){
    	$data = $Request->all();

    	$order =  Order::find($data['order_id']);
    	$order->order_status = $data['order_status'];
    	$order->save();
    	if($order->order_status == 2){
    		foreach ($data['product_id'] as $key => $product_id) {
    			$product = Product::find($product_id);
    			$product_sold = $product->product_sold;
    			$product_qty =  $product->product_qty;
    			foreach ($data['quantity'] as $key2 => $quantity) {
	    			if($key == $key2){
	    				$pro_remain = $product_qty - $quantity;
	    				$product->product_qty = $pro_remain;
	    				$product->product_sold = $product_sold+$quantity;
	    				$product->save();
	    			}	
	    		}
    		}
    	}
    	elseif ($order->order_status == 1 || $order->order_status == 4) {
    		foreach ($data['product_id'] as $key => $product_id) {
    			$product = Product::find($product_id);
    			$product_sold = $product->product_sold;
    			$product_qty =  $product->product_qty;
    			foreach ($data['quantity'] as $key2 => $quantity) {
	    			if($key == $key2){
	    				$pro_remain = $product_qty + $quantity;
	    				$product->product_qty = $pro_remain;
	    				$product->product_sold = $product_sold-$quantity;
	    				$product->save();
	    			}	
	    		}
    		}
    	}
    }
       public function __construct(OrderDetail $OrderDetail,Customer $Customer){
    	$this->OrderDetail = $OrderDetail;
    	$this->Customer = $Customer;
    	
    }
    public function print_order($order_code){
    	$pdf = 	\App::make('dompdf.wrapper');
    	$pdf ->loadHTML($this->print_order_convert($order_code));
    	return $pdf->stream();
    }
    public function print_order_convert($order_code){
    	$this->AuthLogin();
		$detail_order = OrderDetail::where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach ($order as $key => $val) {
			$customer_id = $val->customer_id;
			$shipping_id = $val->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();
		$order_details = $this->OrderDetail->with('product')->where('order_code',$order_code)->get();
		foreach ($order_details as $key => $value) {
			$product_coupon = $value->product_coupon;
			$product_feeship = $value->product_feeship;
			$order_code = $value->order_code;
		}
		$coupon = Coupon::where('coupon_code',$product_coupon)->first();
		if($coupon){
			$coupon_number = $coupon->coupon_number;
			$coupon_condition =  $coupon->coupon_condition;
		}else {
			$coupon_condition = 1;
			$coupon_number =0;
		}
		$output ='';

		$output.='
		<style>
			body{
				font-family:DejaVu Sans;
			}
			h3,h2, h5{

				text-align: center;
			}
			.table{
				width:100%;
				border: 1px solid;
			}
			.tien{
				text-align:right;
			}
			.thead{
				border-bottom: 1px solid #99999;	
			}
			.thead th:not(:last-child){
				border-right: 1px solid;
			}
			.thead tr{
				width:33%;
			}
			.number{
				text-align:center;
			}
			td{
				padding:5px;
				font-size:13px;
			}
			th{
				font-size:15px;
			}
			.tonghoadon{
				text-align:right;
			}
		</style>
		<h3>Công ty TNHH 1 thành viên NTT</h3>
		<h5>Độc lập - Tự do - Hạnh phúc</h5>
		<h2>HÓA ĐƠN</h2>
			<p>Thông tin mua hàng</p>
			<table class="table">
					<thead class="thead">
							<tr>
								<th>Tên khách đặt</th>
								<th class="tien">SĐT</th>
								<th class="tien">Email</th>
							</tr>
					</thead>
					<tbody>';
				$output.='
						<tr>
							<td>'.$customer->customer_name.'</td>
							<td class="tien">'.$customer->customer_phone.'</td>
							<td class="tien">'.$customer->customer_email.'</td>
						</tr>';

				$output.='</tbody>
			</table>
			<br>
			<p>Thông tin vận chuyển</p>
			<table class="table">
					<thead class="thead">
							<tr>
								<th>Người nhận</th>
								<th >SĐT</th>
								<th>Địa chỉ giao hàng</th>
								<th class="tien" >Ghi chú</th>
							</tr>
					</thead>
					<tbody>';
				$output.='
						<tr>
							<td>'.$shipping->shipping_name.'</td>
							<td>'.$shipping->shipping_phone.'</td>
							<td>'.$shipping->shipping_address.'</td>
							<td class="tien">'.$shipping->shipping_notes.'</td>
						</tr>';

				$output.='</tbody>
			</table>
			<br>
			<p>Thông tin đơn hàng</p>
			<table class="table">
					<thead class="thead">
							<tr>
								<th>Tên SP</th>
								<th>SL</th>
								<th class="tien">Giá</th>
								<th class="tien">Thành tiền</th>
							</tr>
					</thead>
					<tbody>';
					$total=0;
					foreach ($order_details as $key => $val) {
						$subtotal = $val->product_sales_quantity*$val->product_price;
						$total+=$subtotal;
						$output.='
							<tr>
								<td>'.$val->product_name.'</td>
								<td class="number">'.$val->product_sales_quantity.'</td>
								<td class="tien">'.number_format($val->product_price,0,',','.').'đ</td>
								<td class="tien">'.number_format($subtotal,0,',','.').'đ</td>
							</tr>';
					}

					if($coupon_condition==1){
						$tonggiam = $coupon_number;
						$coupon_number = $coupon_number;
						$donvi ='đ';
					}
					elseif($coupon_condition==2){
						$tonggiam = $coupon_number*($total/100);
						$coupon_number = $coupon_number;
						$donvi ='%';
					}
					else{
						$tonggiam = 0;
					}
					$vat=0;
					$subtotal_all=$total-$tonggiam;
					$output.='
							<tr >
								<td colspan="4">
									<p class="tonghoadon">Tổng: '.number_format($total,0,',','.').'đ</p>
								</td>
							</tr>
							<tr >
								<td colspan="2">
									<p>Mã giảm giá: '.$product_coupon.' - Giảm: '.number_format($coupon_number,0,',','.').$donvi .'
									</p>
									<p>Tổng giảm: '.number_format($tonggiam,0,',','.').' đ
									</p>
									<p>Tổng sau giảm: '.number_format($subtotal_all,0,',','.').'đ</p>
								</td>
								<td colspan="2">
									<p>Thuế (VAT): '.number_format($vat,0,',','.').'đ
									</p>
									<p>Phí vận chuyển: '.number_format($product_feeship,0,',','.').'đ</p>
									<p>Khách phải thanh toán: '.number_format($subtotal_all+$product_feeship+$vat,0,',','.').' đ</p>
								</td>
							</tr>

					';
				$output.='</tbody>

			</table>
			<br>
			<p class="number">Xác nhận đơn hàng</p>
			<table>
				<thead >
						<tr>
							<th style="width:200px;">Người nhận</th>
							<th style="width:800px;">Người bán hàng</th>
						</tr>
				</thead>
			</table>

			';

    	return  $output;
    }
	public function view_order($order_code){
		$this->AuthLogin();
		$detail_order = OrderDetail::where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach ($order as $key => $val) {
			$customer_id = $val->customer_id;
			$shipping_id = $val->shipping_id;
			$order_status = $val->order_status;
		}
		//xem __construct
		// $this->Customer = DB::table('tbl_customer');
		//$get_customer = $this->Customer->get_customers();
		// $customer = $get_customer->where('customer_id',$customer_id)->first();
		//hoac
		$customer = Customer::where('customer_id',$customer_id)->first();

		$shipping = Shipping::where('shipping_id',$shipping_id)->first();
		$order_details = $this->OrderDetail->with('product')->where('order_code',$order_code)->get();

		foreach ($order_details as $key => $value) {
			$product_coupon = $value->product_coupon;
			$product_feeship = $value->product_feeship;
			$order_code = $value->order_code;
		}	
		$coupon = Coupon::where('coupon_code',$product_coupon)->first();
		if($coupon){
			$coupon_number = $coupon->coupon_number;
			$coupon_condition =  $coupon->coupon_condition;
		}else {
			$coupon_condition = 1;
			$coupon_number =0;
		}
		return view('admin.view-order-ajax')->with(compact('detail_order','customer','shipping','order_details','coupon_number','coupon_condition','product_feeship','order_code','order','order_status'));
	}
    public function manage_order(){
    	$this->AuthLogin();
    	$orders = Order::orderby('created_at','DESC')->get();
    	return view('admin.manage-order')->with(compact('orders'));
    }
}
