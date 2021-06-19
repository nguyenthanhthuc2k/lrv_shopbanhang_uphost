@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm phí vận chuyện
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
                        <form>
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
                         <div class="form-group">
                            <label for="exampleInputEmail1">Phí vận chuyển</label>
                            <input type="number" maxlength="50"  name="feeship"class="form-control feeship" id="exampleInputEmail1" placeholder="Nhập phí vận chuyển">
                        </div>  
                        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm thương hiệu</button> 

                        </form>
                    </div>
                    <br>
                   <div id="load_table_delivery">
                        
                    </div>
                </div>
            </section>

    </div>
</div>
@endsection