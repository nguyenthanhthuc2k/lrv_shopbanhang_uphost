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
	</section>
	<section id="do_action">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền <span>{{Cart::subtotal().' '.'vnđ'}}</span></li>
							<li>Thuế <span>{{Cart::tax().' '.'vnđ'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Tổng <span>{{Cart::total()}} vnđ</span></li>
						</ul>
							<!-- <a class="btn btn-default update" href="">Update</a> -->
							
							   <?php 
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id != null && $shipping_id == null){
                                 ?>
                                 <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                                 <?php } elseif($customer_id != null && $shipping_id != null){?>
								<a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Thanh toán</a>
								<?php }else{?>

                                     <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                                <?php } ?>
					</div>
				</div>
			</div>
	</section><!--/#do_action-->
@endsection