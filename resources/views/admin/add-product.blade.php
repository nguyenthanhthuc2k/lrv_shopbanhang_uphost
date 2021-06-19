@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm sản phẩm
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
                        <form role="form" action="{{URL::to('/save_product')}}" method="post" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" maxlength="100" name="product_name"class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="number" name="product_price"class="form-control" onkeypress="return isNumberKey(event)" id="" >
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng tồn kho</label>
                            <input type="number" name="product_qty"class="form-control" onkeypress="return isNumberKey(event)" id="" >
                        </div>   
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh đại diện sản phẩm</label>
                            <input type="file" name="product_image"class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea   style="resize: none;" rows="5"type="text"  name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa tìm kiếm sản phẩm</label>
                            <textarea   style="resize: none;" rows="5"type="text"  name="product_meta_keywords" class="form-control" id="exampleInputPassword1" placeholder="Từ khóa tìm kiếm sản phẩm"></textarea>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea  style="resize: none;" rows="5"type="text"  name="product_content" class="form-control" id="ckeditoraddproduct" placeholder="Nội dung sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>
                        <div class="form-group"> 
                            <label for="exampleInputPassword1">Loại sản phẩm</label>
                            <select name="product_category" class="form-control input-sm m-bot15">
                                @foreach($category_product as $key => $v)
                                <option value="{{$v->category_id}}">{{$v->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                 @foreach($brand_product as $key => $v)
                                <option value="{{$v->brand_id }}">{{$v->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection