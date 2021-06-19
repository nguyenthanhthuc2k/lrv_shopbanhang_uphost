@extends('layout')
@section('content')
				@foreach($product_detail as $key => $v)
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/upload/product/'.$v->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{URL::to('/public/user/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/user/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/user/images/similar1.jpg')}}" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="{{URL::to('/public/user/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/user/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/user/images/similar1.jpg')}}" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="{{URL::to('/public/user/images/new.jpg')}}" class="newarrival" alt="" />
								<h2>{{ $v->product_name}}</h2>
								<p>ID: {{ $v->product_id}}</p>
								<img src="{{URL::to('/public/user/images/rating.png')}}" alt="" />
								<form method="POST" action="{{URL::to('/save-cart')}}">
									{{ csrf_field()}}
								<span>
									<span>{{ number_format($v->product_price,0, ',', '.')}} </span><span class="don-vi">VNĐ</span>
									<label>Số lượng:</label>
									<input name="qty" type="number"  value="1" min="1" />
									<input name="product_id_hidden" type="hidden"  value="{{ $v->product_id}}" />
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm giỏ hàng
									</button>
								</span>
								</form>
								<p><b>Tồn kho:</b> Còn hàng</p>
								<p><b>Tình trạng:</b> Mới 100%</p>
								<p><b>Thương hiệu:</b> {{ $v->brand_name}}</p>
								<p><b>Danh mục:</b> {{ $v->category_name}}</p>
								<div style="display: flex;">	
									<div class="fb-share-button" data-href="http://localhost/lrv_shopbanhang/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>

									<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
								</div>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div>
					<!--/product-details-->
				@endforeach	
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li ><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="content">
									{{ $v->product_content}}
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								{{ $v->product_content}}
							</div>
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									@foreach($related_product as $key => $related_product)	
									<a href="{{URL::to('/chi-tiet-san-pham/'.$related_product->product_id)}}">
			                            <div class="col-sm-4">
			                                <div class="product-image-wrapper">
			                                    <div class="single-products">
			                                            <div class="productinfo text-center">
			                                                <img src="{{URL::to('public/upload/product/'.$related_product->product_image)}}" alt="" />
			                                                <h2>{{ number_format($related_product->product_price, 0, '', '.')}} <span class="don-vi">VNĐ</span></h2>
			                                                <p>{{ $related_product->product_name }}</p>
			                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
			                                            </div>
			                                    </div>
			                                    <div class="choose">
			                                        <ul class="nav nav-pills nav-justified">
			                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
			                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
			                                        </ul>
			                                    </div>
			                                </div>
			                            </div>
                           			 </a>
									@endforeach
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection