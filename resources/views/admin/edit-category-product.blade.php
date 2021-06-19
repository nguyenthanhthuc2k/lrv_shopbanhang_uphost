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
                    @foreach($edit_category_product as $key => $v)
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update_category_product/'.$v->category_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $v->category_name }}" name="cat_product_name"class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea  style="resize: none;" rows="5"type="text"name="cat_product_desc" class="form-control" id="exampleInputPassword1">{{ $v->category_desc }} </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa danh mục</label>
                            <textarea  style="resize: none;" rows="5"type="text"  name="cat_product_keywords" class="form-control" id="exampleInputPassword1" placeholder="Nhập từ khóa danh mục">{{ $v->category_meta_keywords }}</textarea>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Lưu thay đổi</button>
                    </form>
                    </div>
                    @endforeach

                </div>
            </section>

    </div>
</div>
@endsection