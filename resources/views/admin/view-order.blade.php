@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua
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
          @foreach($customer_by_id as $key => $v_customer)
          <tr>
            <td>{{$v_customer->customer_name}}</td>
            <td>{{$v_customer->customer_phone}}</td>
            <td>{{$v_customer->customer_email}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người hàng nhận</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ giao hàng</th>
            <th>Ghi chú</th>
          </tr>
        </thead>
        <tbody>
          @foreach($shipping_by_id as $key => $v_shipping)
          <tr>
            <td>{{$v_shipping->shipping_name}}</td>
            <td>{{$v_shipping->shipping_email}}</td>
            <td>{{$v_shipping->shipping_address}}</td>
            <td>{{$v_shipping->shipping_notes}}</td>
          </tr>
          @endforeach
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
            <th>Tên sản phẩm</th>
            <th>Hình ảnh sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order_by_id as $key => $v_product)
          <tr>
            <td>{{$v_product->product_name}}</td>
             <td><img src="{{URL::to('/public/upload/product/'.$v_product->product_image)}}" width="100" height="100">  </td>
            <td>{{$v_product->product_price}}</td>
            <td>{{$v_product->product_sales_quantity}}</td>
            <td>{{$v_product->product_price*$v_product->product_sales_quantity}}</td>
          </tr>
          @endforeach
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