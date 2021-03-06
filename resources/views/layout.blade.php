<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- seo -->
    <title> {{ $meta_title }} </title>
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="author" content="">
    <meta name="robots" content="INDEX,FOLLOW">
    <link  rel="shortcut icon" type="image/x-icon" href="" />
    <!-- //seo -->
    <!-- share -->
    <meta property="og:image" content="http://localhost/lrv_shopbanhang" />
    <meta property="og:site_name" content="thiatv.com" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />
    <!--// share -->
    <link  rel="canonical" href="{{ $url_canonical }}" />
    <link href="{{asset('public/user/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{('public/user/images/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-star"></i> S???n ph???m y??u th??ch</a></li>
                                <?php 
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id != null && $shipping_id == null){
                                 ?>

                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>

                                <?php } elseif($customer_id != null && $shipping_id != null){?>
                                     <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>

                                <?php } else{?>

                                      <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>

                                <?php  }?>

                               <!--  <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Gi??? h??ng</a></li> -->
                                <li><a href="{{URL::to('/show-cart-ajax')}}"><i class="fa fa-shopping-cart"></i> Gi??? h??ng</a></li>

                                <?php 
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){
                                 ?>
                                     <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> ????ng xu???t</a></li>
                                 <?php } else{?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> ????ng nh???p</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('trang-chu')}}" class="active">Trang ch???</a></li>
                                <li class="dropdown"><a href="#">S???n ph???m<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin t???c<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
                                        <li><a href="blog-single.html">Li??n h???</a></li>
                                    </ul>
                                </li> 
                                <li><a href="404.html">Gi??? h??ng</a></li>
                                <li><a href="contact-us.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <form method="POST" action="{{URL::to('/tim-kiem')}}">
                            {{ csrf_field()}}
                            <div class="search_box pull-right">
                                <input type="text" name="keysword_submit" placeholder="T??m ki???m.."/>  
                                <input type="submit" style="margin-top: 0; color: #fff;width: 40px;"name="submit_keysword" class="btn btn-primary" value="T??m"> 
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{URL::to('public/user/images/girl1.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{URL::to('public/user/images/pricing.png')}}"  class="pricing" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{URL::to('public/user/images/girl2.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{URL::to('public/user/images/pricing.png')}}"  class="pricing" alt="" />
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1> 
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{URL::to('public/user/images/girl3.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{URL::to('public/user/images/pricing.png')}}" class="pricing" alt="" />
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh m???c s???n ph???m</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($category as $key => $cat)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cat->category_id)}}">{{ $cat->category_name }}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Th????ng hi???u</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right"></span>{{ $brand->brand_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range-->
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{('public/user/images/shipping.jpg')}}" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{('public/user/images/iframe1.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{('public/user/images/map.png')}}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ???s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright ?? 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('public/user/js/jquery.js')}}"></script>
    <script src="{{asset('public/user/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/user/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/user/js/price-range.js')}}"></script>
    <script src="{{asset('public/user/js/jquery.prettyPhoto.js')}}"></script>
     <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{asset('public/user/js/main.js')}}"></script>
    <script src="{{asset('public/user/js/sweetalert.js')}}"></script>
    <!-- <script src="{{asset('public/user/js/sweetalert.min.js')}}"></script> -->
    <!-- script share -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="V9YufYS9"></script>

    <script type="text/javascript">
        $(document).ready(function(){
             $('.calculator_delivery').click(function(){
                let city = $('.city').val();
                let province = $('.province').val();
                let wards = $('.wards').val();
                let _token = $('input[name="_token"]').val();
                if(city =='' && province =='' && wards ==''){
                    alert('Chon ?????a ch??? ??i th???ng lol');
                }else{
                    $.ajax({
                        url: '{{url('/calculator-delivery')}}',
                        method: 'POST',
                        data:{city:city,province:province,wards:wards,_token:_token},
                        success:function(data){
                            location.reload();
                        }
                    });
                }
             });
            $('.choose').on('change',function(){
                let action = $(this).attr('id');
                let ma_id = $(this).val();
                let _token = $('input[name="_token"]').val();
                let result = '';
                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    url: '{{url('/select-delivery-home')}}',
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
             });
            $('.add-to-cart').click(function(){
                let id = $(this).data('id_product');
                let cart_product_id = $('.cart_product_id_' + id).val();
                let cart_product_name = $('.cart_product_name_' +id).val();
                let cart_product_price = $('.cart_product_price_' +id).val();
                let cart_product_image = $('.cart_product_image_' +id).val();
                let cart_product_qty = $('.cart_product_qty_' +id).val();
                let _token = $('input[name="_token"]').val();
                // alert(_token);
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_price:cart_product_price,cart_product_image:cart_product_image,cart_product_qty:cart_product_qty,_token:_token},
                    success:function(data){

                        swal("Good job!", "Th??m gi??? h??ng th??nh c??ng", "success")
                        
                    }
                })
            })
        });
    </script>
    <script type="text/javascript">
         $(document).ready(function(){
         $('.send-order').click(function(){
            if($('.shipping_email').val() == '' || $('.shipping_name').val() == ''|| $('.shipping_phone').val() == ''|| $('.shipping_address').val() == ''|| $('.shipping_notes').val() == ''|| $('.payment').val() == ''){
                swal("Thanks!", "Vui l??ng nh???p th??ng tin nh???n h??ng", "error");
            }
            else if($('.shipping_fee').val() == ''){
                 swal("Thanks!", "Vui l??ng t??nh ph?? v???n chuy???n", "error");
             }
            else{
                swal({
                  title: "X??c nh???n ????n h??ng ?",
                  text: "B???n c??  ch???n ch???n mu???n ?????t h??ng!",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Ok, Ch???t ????n",
                   cancelButtonText: "No, Mua cc!",
                  closeOnConfirm: false,
                   closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        let shipping_email = $('.shipping_email').val();
                        let shipping_name = $('.shipping_name').val();
                        let shipping_phone = $('.shipping_phone').val();
                        let shipping_address = $('.shipping_address').val();
                        let shipping_notes = $('.shipping_notes').val();
                        let shipping_fee = $('.shipping_fee').val();
                        let shipping_method = $('.payment').val();
                        let shipping_cou = $('.shipping_cou').val();
                        let _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: '{{url('/confirm-order-ajax')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_phone:shipping_phone,shipping_address:shipping_address,shipping_notes:shipping_notes,shipping_fee:shipping_fee,shipping_cou:shipping_cou,_token:_token,shipping_method:shipping_method},
                            success:function(data){
                                 swal("Thanks!", "????n h??ng c???a b???n ???? ???????c ti???p nh???n ch??? x??? l??", "success");
                                //  $('form :input').val('');
                                // $('form :select').val('');
                            }
                        })
                        window.setTimeout(function(){
                            location.reload();
                        },3000);
                      } else {
                        swal("Thanks!", "????n h??ng  ???? h???y :<", "error");
                      }
                });
            }
            
            })
     }); 
    </script>
</body>
</html>