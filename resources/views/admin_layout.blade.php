<!DOCTYPE html>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/admin/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/admin/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/admin/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/admin/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/admin/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/admin/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/admin/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/admin/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/admin/js/raphael-min.js')}}"></script>
<script src="{{asset('public/admin/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/admin/images/2.png')}}">
                <span class="username">
                    <?php 
                        $name = Session::get('admin_name');
                        if($name){
                            echo $name;
                        }
                     ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="index.html">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-order')}}">Quản lí đơn hàng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('add-coupon')}}">Tạo mã giảm giá</a></li>
                        <li><a href="{{URL::to('all-coupon')}}">Quản lí mã giảm giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-copyright"></i>
                        <span>Vận chuyển</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Quản lí phí vận chuyển</a></li>
                        <li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-copyright"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
                        <li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                        <li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
    </section>
 <!-- footer -->
	  <div class="footer">
		<div class="wthree-copyright">
		  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
		</div>
	  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/admin/js/addscript.js')}}"></script>
<script src="{{asset('public/admin/js/bootstrap.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/admin/js/scripts.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/admin/ckeditor/ckeditor.js')}}"></script>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditoraddproduct');
    CKEDITOR.replace('ckeditoreditproduct');
</script>
<script src="{{asset('public/admin/js/jquery.form-validator.min.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<script type="text/javascript">
    $(document).ready(function(){
        $('.update_qty_order').click(function(){
            let order_product_id = $(this).data('product_id'); 
            let order_qty_id = $('.order_qty_'+order_product_id).val();
            let order_code = $('.order_code').val();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/update-order-qty')}}',
                method: 'POST',
                data:{order_code:order_code,order_product_id:order_product_id,order_qty_id:order_qty_id,_token:_token},
                success:function(data){
                    location.reload();
                    alert('Cập nhật sl thành công');
                }
            });
        })
    })


</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.order_status').change(function(){
            let order_status = $(this).val();
            let order_id = $(this).children(":selected").attr("id");
            let _token = $('input[name="_token"]').val();

            //lay ra so lương
            quantity = [];
            $('input[name="quantity"]').each(function(){
                quantity.push($(this).val());
            });
            // alert(quantity);
            //lay ra product id
            product_id = [];
            $('input[name="order_product_id"]').each(function(){
                product_id.push($(this).val());
            });
            j = 0;
            for(i=0; i < product_id.length;i++){
                let order_product_storage_id = $('.order_product_storage_'+product_id[i]).val();
                let order_qty_id = $('.order_qty_'+product_id[i]).val();
                if(parseInt(order_product_storage_id) < parseInt(order_qty_id))
                {
                    $('.color_'+product_id[i]).css('background','#34495e');
                    j+=1;
                }
            }

            if(j == 1){
                alert('Số lượng khách đặt lớn hơn số lượng trong kho');
            }
            else{
                // if(order_status != 1){
                    $.ajax({
                        url: '{{url('/update-order-status')}}',
                        method: 'POST',
                        data:{order_status:order_status,order_id:order_id,_token:_token,quantity:quantity,product_id:product_id},
                        success:function(data){
                            location.reload();
                            alert('Cập nhật trạng thái đơn hành thành công');
                        }
                    });
                // }
            }
            // alert(product_id);
            // alert(_token);

        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        fetch_delirery();
        function fetch_delirery(){
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/select-feeship')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                    $('#load_table_delivery').html(data);
                }
            });
        }
        $(document).on('blur','.feeship_edit',function(){
            let feeship_id = $(this).data('fee_ship');
            let fee_number = $(this).text();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/update-delivery')}}',
                method: 'POST',
                data:{feeship_id:feeship_id,fee_number:fee_number,_token:_token},
                success:function(data){
                    fetch_delirery();
                    // $('form :input').val('');
                }
            });
        });
        // $(documen t).on('blur','.fee_feeship_edit',function(){
        //     var feeship_id = $(this).data('feeship_id');
        //     var fee_value = $(this).text();
        //      var _token = $('input[name="_token"]').val();
        //     // alert(feeship_id);
        //     // alert(fee_value);
        //     $.ajax({
        //         url : '{{url('/update-delivery')}}',
        //         method: 'POST',
        //         data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
        //         success:function(data){
        //            fetch_delivery();
        //         }
        //     });

        // });
        $('.add_delivery').click(function(){
            let city = $('.city').val();
            let province = $('.province').val();
            let wards = $('.wards').val();
            let feeship = $('.feeship').val();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/insert-delivery')}}',
                method: 'POST',
                data:{city:city,province:province,wards:wards,feeship:feeship,_token:_token},
                success:function(data){
                    
                    fetch_delirery();
                }
            });

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
                url: '{{url('/select-delivery')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
    })
</script>
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/admin/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
