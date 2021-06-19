@extends('admin_layout')
@section('admin_content')

	</div>
	<div class="col-ms-6">
		
	</div>
</div>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <?php 
    $message = Session::get('message');
    if($message){
      echo $message;
      Session::put('message',null);
    }
   ?>
    <div class="row w3-res-tb">
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tạo</th>
            <th>Tình trạng đơn hàng</th>
            <th style="width:100px;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
         @php
         	$i = count($orders)+1;
         @endphp
         @foreach($orders as $key => $order)
         @php
         	$i--;
         @endphp
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$i}}</td>
            <td>{{strtoupper($order->order_code)}}</td>
             <td>{{strtoupper($order->created_at)}}</td>
            <td> 
            	
            	@if($order->order_status==1)
            		Chờ xử lí

            	@elseif($order->order_status==2)
            		Đang giao hàng
              @elseif($order->order_status==3)
                Thành công
            	@else
            		Đã hủy
            	@endif

            </td>
            <td>
              <a href="{{URL::to('/view-order/'.$order->order_code)}}" class="active" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i>
              <a href="{{URL::to('/delete-order/')}}" onClick="return confirm('Delete entry?')" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
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