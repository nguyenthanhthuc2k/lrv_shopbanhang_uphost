@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
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
                        <form role="form" action="{{URL::to('/update_brand_product/'.$edit_brand_product->brand_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $edit_brand_product->brand_name }}" name="brand_product_name"class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea  style="resize: none;" rows="5"type="text"name="brand_product_desc" class="form-control" id="exampleInputPassword1">{{ $edit_brand_product->brand_desc }} </textarea>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa tìm kiếm</label>
                            <textarea  style="resize: none;" rows="5"type="text"  name="brand_meta_keywords" class="form-control" id="exampleInputPassword1">{{ $edit_brand_product->brand_meta_keywords }} </textarea>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Lưu thay đổi</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection