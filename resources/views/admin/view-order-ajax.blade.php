@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin đặt hàng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người mua hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin nhận hàng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người hàng nhận</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ giao hàng</th>
            <th>Ghi chú</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_notes}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng
    </div>
    <?php 
    $message = Session::get('message');
    if($message){
      echo $message;
      Session::put('message',null);
    }
   ?>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh sản phẩm</th>
            <th>Mã giảm giá</th>
            <th>Giá</th>
            <th>Số lượng tồn kho</th>
            <th>Số lượng khách đặt</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
          @php $i=count($order_details)+1;$total=0;  @endphp
          @foreach($order_details as $key => $v_product)

          @php $i--;$subtotal=$v_product->product_price*$v_product->product_sales_quantity; $total+=$subtotal; @endphp
          <tr class="color_{{$v_product->product_id}}">
            <td>{{$i}}</td>
            <td>{{$v_product->product_name}}</td>
             <td><img src="{{URL::to('/public/upload/product/'.$v_product->product->product_image)}}" width="100" height="100">  </td>
             <td>
              @if($v_product->product_coupon != 'no')
                {{$v_product->product_coupon}}
              @else
                Không có
              @endif</td>
            <td>{{number_format($v_product->product_price,0,',','.')}} đ</td>
             <td>{{$v_product->product->product_qty}}</td>
            <td>
               @if($order_status == 1)
              <input name="quantity"   class="form-control order_qty_{{$v_product->product_id}}"   min="1" type="number" onkeypress="return isNumberKey(event)" name="" value="{{$v_product->product_sales_quantity}}">
              @else
              <input name="quantity" disabled  class="form-control order_qty_{{$v_product->product_id}}"   min="1" type="number" onkeypress="return isNumberKey(event)" name="" value="{{$v_product->product_sales_quantity}}">
              @endif
              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$v_product->product_id}}"> 
              <input type="hidden" name="order_product_storage" class="order_product_storage_{{$v_product->product_id}}"value="{{$v_product->product->product_qty}}">
               <input type="hidden" name="order_code" class="order_code"value="{{$v_product->order_code}}">
              @if($order_status == 1)
                <button type="button" data-product_id="{{$v_product->product_id}}" class="btn btn-default update_qty_order">Cập nhật</button>
              @endif
            </td>
            <td>{{number_format($subtotal,0,',','.') }}đ</td>
          </tr>
          
          @endforeach

          <tr>
            <td colspan="2">
              
            <!-- -->
            @php $subtotal = 0; @endphp
            @if( $coupon_condition == '1')
              Tổng giảm :{{number_format($coupon_number,0,',','.') }}đ <br>
              Tổng sau giảm:@php $subtotal =$total- $coupon_number; echo(number_format($subtotal,0,',','.')) @endphp đ 
            @elseif($coupon_condition == '2')
              Tổng giảm:{{number_format($total*($coupon_number/100),0,',','.') }}đ <br>
              Tổng sau giảm: @php $subtotal = $total-($total*($coupon_number/100)); echo(number_format($subtotal,0,',','.')) @endphp đ 
            @endif 

            </td>
            <td colspan="2">
              Phí Ship: {{number_format($product_feeship,0,',','.')}} đ<br>
              Khách phải thanh toán: {{number_format($product_feeship + $subtotal,0,',','.')}} đ
            </td>
          </tr>
          <tr>
            <td colspan="3">
              @foreach($order as $key => $val)
                <form>
                  @csrf
                   <select class="form-control order_status">
                  @if($val->order_status == 1)
                      <option  id="{{$val->order_id}}" selected value="1">Chờ xử lí</option>
                      <option  id="{{$val->order_id}}" value="2">Đang giao hàng</option>
                      <option  id="{{$val->order_id}}" value="4">Đã hủy</option>
                   @elseif($val->order_status == 2)
                      <option  id="{{$val->order_id}}"  value="1">Chờ xử lí</option>
                      <option id="{{$val->order_id}}"  selected value="2">Đang giao hàng</option>
                      <option id="{{$val->order_id}}"  value="3">Thành công</option>
                      <option id="{{$val->order_id}}"  value="4">Đã hủy</option>
                    @elseif($val->order_status == 3)
                      <option  id="{{$val->order_id}}" selected value="3">Thành công</option>
                    @elseif($val->order_status == 4)
                      <option  id="{{$val->order_id}}"  value="1">Chờ xử lí</option>
                      <option  id="{{$val->order_id}}"  value="2">Đang giao hàng</option>
                      <option id="{{$val->order_id}}"  selected value="4">Đã hủy</option>
                   @endif
                   </select>
                </form>
             @endforeach
            </td>
          </tr>
          <tr>
            <td>
              <a href="{{url::to('/print-order/'.$order_code)}}" target="_blank">In hóa đơn</a>
            </td>
          </tr>
        </tbody>
      </table>

    </div>  
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection