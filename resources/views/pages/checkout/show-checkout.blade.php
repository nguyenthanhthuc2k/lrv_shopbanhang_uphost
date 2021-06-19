@extends('layout')
@section('content')
	<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<form method="POST" style="
					display: flex;" action="{{URL::to('/update-cart-ajax')}}">
				@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description" style="width: 250px;">Tên</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td>Thao tác</td>
						</tr>
					</thead>
					<tbody>
						<?php 
						$total=0;
						if(Session::get('cart') != null){
							
						 ?>
						 @foreach(Session::get('cart') as $key => $cart)
						 <?php 
						 	$subtotal = $cart['product_price']*$cart['product_qty'];
						 	$total+=$subtotal;
						  ?>
						<tr>
							<td class="cart_product">
								<a href=""><img width="50" src="{{URL::to('public/upload/product/'.$cart['product_image'])}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}">{{ $cart['product_name'] }}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{ number_format($cart['product_price'],0,',','.') }} đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="number" min="1" style="width: 40px;"name="cart_qty[{{$cart['session_id']}}]" value="{{ $cart['product_qty'] }}" autocomplete="off" size="2">
									<input class="form-control" type="hidden" name="rowId_product" value="" >
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{ number_format($subtotal,0,',','.') }} đ
								</p>
							</td>
							<td class="cart_delete" style="text-align: center;">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-product-cart-ajax/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td>
								<input type="submit" name="" value="Cập nhật giỏ hàng" class="btn btn-default check_out" name="update_qty">
							</td>
							<td>
								<a href="{{URL::to('/delete-all-product-cart')}}" class="btn btn-default check_out" name="delete_all_product_cart">Xóa tất cả</a>
							</td>
							
						</tr>
					<?php } else { ?>
						<tr>
							<td colspan="6" style="padding-top: 30px;">
								<center>
								<p>Không có sản phẩm trong giỏ hàng</p>
								</center>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				</form>
			</div>

			@if(session()->has('message'))
				<div class="alert alert-success">
					{{session()->get('message')}}
				</div>
			@elseif(session()->has('error'))
				<div class="alert alert-danger">
					{{session()->get('error')}}
				</div>
			@endif
				<?php 
		if(session::get('cart') != null){
	 ?>
	<section id="do_action">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area"  style="padding: 15px 10px;">
					<form >
                        @csrf
                       
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tỉnh/Thành Phố</label>
                            <select name="city"  id="city" class="form-control input-sm m-bot15 choose city">
                                <option value="">---Chọn Tỉnh/Thành Phố---</option>
                                @foreach($city as $key =>$val)
                                <option value="{{$val->matp}}">{{$val->name_tp}}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Quận/Huyện</label>
                            <select name="province"  id="province" class="form-control input-sm m-bot15 province choose">
                                <option value="">---Chọn Quận/Huyện---</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Phường/Xã/Thị trấn</label>
                            <select name="wards" id="wards"  class="form-control input-sm m-bot15 wards">
                                 <option value="">---Phường/Xã/Thị trấn---</option>
                            </select>
                        </div>
							<input type="button" name="calculator_delivery" class="btn btn-primary calculator_delivery" value="Tính phí vận chuyển">
                    </form>
                    
                	</div>
                </div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền <span>{{ number_format($total,0,',','.') }} đ</span></li>
							
							@if(Session::get('coupon'))
								@foreach(Session::get('coupon') as $key => $cou)
									@if($cou['coupon_condition']==2)
										 <li>Mã giảm <span>{{$cou['coupon_number']}} %</span></li>
										 @php
										 	$total_coupon = ($total*$cou['coupon_number'])/100;
										 @endphp
										  <li>Đã giảm <span>{{number_format($total_coupon,0,',','.')}} đ</span></li>
									@elseif($cou['coupon_condition']==1)
										 <li>Mã giảm <span>{{number_format($cou['coupon_number'],0,',','.')}} đ</span></li>
										 @php
										 	$total_coupon = $cou['coupon_number'];
										 @endphp
									@endif
								@endforeach
							@endif
							<li>Thuế <span></span></li>
							@if(Session::get('coupon'))
								<li>Tổng cộng <span>{{number_format($total-$total_coupon,0,',','.')}} đ</span></li>
							@else
								<li>Tổng cộng <span>{{number_format($total,0,',','.')}} đ</span></li>
							@endif

							@if(Session::get('fee'))
							<li>Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}} đ</span></li>
							@endif

							<form method="POST"  style="display:flex;"action="{{URL::to('/check-coupon')}}">
								@csrf
								<input type="text" min="1" placeholder="Mã giảm giá" class="form-control " style="margin-top: 18px;" name="coupon">
								<input type="submit" value="Cập nhật giá"  class="btn btn-default check_out" name="update_check_coupon">
							</form>
							<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>

							<!-- <a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Thanh toán</a> -->
							@if(Session::get('coupon'))
							<a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa khuyến mãi</a>
							@endif
							</ul>
					</div>
				</div>
			</div>
	</section>
	<div class="shopper-informations">
		<div class="bill-to">
			<p>Thông tin nhận hàng</p>
			<div class="form-one">
				<form method="POST">
					@csrf
					<input type="text" name="shipping_email"class="shipping_email" required placeholder="Địa chỉ email">
					<input type="text" name="shipping_name"class="shipping_name" required placeholder="Họ và tên">
					<input type="text" name="shipping_phone"class="shipping_phone" required placeholder="Số điện thoại">
					<input type="text" name="shipping_address"class="shipping_address" required placeholder="Địa chỉ nhận hàng">
					<textarea name="shipping_notes" class="shipping_notes" required placeholder="Ghi chú đơn hàng" rows="5"></textarea>
					@if(Session::get('fee'))
						<input type="hidden" name="shipping_fee"class="shipping_fee" value="{{Session::get('fee')}}">
					@else
						<input type="hidden" name="shipping_fee"class="shipping_fee" value="">
					@endif
					@if(Session::get('coupon'))
						@foreach(Session::get('coupon') as $key => $cou)
						<input type="hidden" name="shipping_cou" class="shipping_cou" value="{{$cou['coupon_code']}}">
						@endforeach
					@else
						<input type="hidden" name="shipping_cou"class="shipping_cou" value="no">
					@endif

					<div class="form-group">
						<br>
	                    <select name="payment" id="payment" class="form-control input-sm m-bot15 payment">
	                         <option value="">----Chọn hình thức thanh toán----</option>
	                         <option value="1">Thanh toán khi nhận hàng</option>
	                         <option value="2">Thanh toán qua ATM</option>
	                    </select>
	                </div>
	                <div style="text-align: center;">
	                	
					<button type="button" name="send-order" style="margin:10px;" class="btn btn-primary send-order" value="">Xác nhận đơn hàng</button>
	                </div>
				</form>
			</div>
		</div>
	</div>
	<?php }?>
@endsection