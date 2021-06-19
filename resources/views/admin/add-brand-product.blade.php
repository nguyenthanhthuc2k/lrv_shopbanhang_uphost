@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
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
                        <form role="form" action="{{URL::to('/save_brand_product')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" maxlength="50"  name="brand_product_name"class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thương hiệu">
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea  style="resize: none;" rows="5"type="text"  name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả thương hiệu"></textarea>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa tìm kiếm</label>
                            <textarea  style="resize: none;" rows="5"type="text"  name="brand_meta_keywords" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô từ khóa tìm kiếm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection