@extends('layout')
@section('content')
	<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
							<div class="table-responsive cart_info">
				<?php 
					$content = Cart::content();
				 ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content  as $key =>$v_product)
						<tr>
							<td class="cart_product">
								<a href=""><img width="50" src="{{URL::to('public/upload/product/'.$v_product->options->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_product->name}}</a></h4>
								<!-- <p>Web ID: 1089772</p> -->
							</td>
							<td class="cart_price">
								<p>{{number_format($v_product->price,'0',',','.')}} vnđ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form method="POST" action="{{URL::to('/update-cart-qty')}}">
										{{ csrf_field()}}
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_product->qty}}" autocomplete="off" size="2">
									<input class="form-control" type="hidden" name="rowId_product" value="{{$v_product->rowId}}" >
									<input type="submit" name="" value="Cập nhật" name="update_qty"></form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php 
										//tinh tong tien cua 1 sp
										$tong1sp = $v_product->price * $v_product->qty;
										echo number_format($tong1sp,'0',',','.').' vnđ';
									 ?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-product-cart/'.$v_product->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			</div>
			<form method="POST" action="{{URL::to('/order-place')}}">
				{{ csrf_field()}}
			<div class="payment-options">
				<h2>Chọn hình thức thanh toán</h2>
					<span>
						<label><input name="payment_option" value="1"type="checkbox"> Trả bằng ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2"type="checkbox"> Thanh toán sau nhận hàng</label>
					</span>
					<span>
						<label><input name="payment_option" value="3"type="checkbox"> Thẻ ghi nợ</label>
					</span>
					<span>
						<input type="submit" name="send-order-place" class="btn btn-primary" value="Đặt hàng">
					</span>
			</div>
			</form>
	</section> <!--/#cart_items-->

@endsection