@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Tạo mã giảm giá
                </header>
                <?php 
                    $message = Session::get('message');
                    if($message){
                    echo $message;
                    Session::put('message',null);
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-insert-coupon')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input type="text" maxlength="50"  name="coupon_name"class="form-control" id="exampleInputEmail1">
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã giảm giá</label>
                            <input type="text" maxlength="50"  name="coupon_code"class="form-control" id="exampleInputEmail1">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng</label>
                           <input type="text" maxlength="50"  name="coupon_time"class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính năng</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0">----Chọn----</option>
                                <option value="1">Giảm theo tiền</option>
                                <option value="2">Giảm theo %</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số % hoặc số tiền giảm</label>
                           <input type="text" maxlength="50"  name="coupon_number"class="form-control" id="exampleInputEmail1" >
                        </div>
                        <button type="submit" name="add_coupon" class="btn btn-info">Tạo</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection