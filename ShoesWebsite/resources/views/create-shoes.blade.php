<!doctype html>
<html lang="en">
@include('.admin_layout.header')

<body class="vertical  light  ">
<div class="wrapper">
    @include('.admin_layout.nav')
    <main role="main" class="main-content">
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if ($message = \Illuminate\Support\Facades\Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if ($message = \Illuminate\Support\Facades\Session::get('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <form action="{{route('shoe.store')}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div>
                <h1>Thêm mới sản phẩm</h1>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Tên sản phẩm</label>
                        <input type="text" class="form-control"
                               required="" id="inputEmail4" placeholder="Tên sản phẩm" name="shoesname">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Danh mục</label>
                        <select id="inputState" class="form-control" name="id_category">
                            @foreach($category as $item)
                                <option selected value="{{$item->id_category}}">{{$item->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Thương hiệu</label>
                        <select id="inputState" class="form-control" name="id_brand">
                            @foreach($brand as $item)
                                <option selected value="{{$item->id_brand}}">{{$item->brandname}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row" >
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Giá nhập</label>
                        <input type="number" class="form-control" id="inputPassword4"
                               required="" placeholder="vnd" name="prices_buy">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Giá bán</label>
                        <input type="number" class="form-control"
                              required="" id="inputPassword4" placeholder="vnd" name="prices_sell">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Ảnh nổi bật</label>
                        <input type="file" class="form-control"
                               required="" id="inputPassword4" name="file">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Ảnh chi tiết</label>
                        <input type="file" class="form-control"
                               required="" id="inputPassword4" name="files[]" multiple="multiple">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Số lượng</label>
                        <input type="number" class="form-control"
                               required="" id="inputPassword4" name="quantity">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Tiêu đề</label>
                        <input type="text" class="form-control"
                               required="" id="inputPassword4" name="title" placeholder="Nhập tiêu đề..">
                    </div>
                </div>
                <div class="form-row">
                    <label class="form-group" >Màu</label>
                    <div class="form-group col-md-12">
                        @foreach($color as $items2)
                            <label class="form-group" for="{{$items2->id_color}}">
                                {{$items2->color_name}}
                            </label>
                            <input class="form-check-inline" type="checkbox" id="{{$items2->id_color}}" value="{{$items2->id_color}}" name="colors[]">
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <label class="form-group">Size</label>
                    <div class="form-group col-md-12">
                        @foreach($size as $items)
                            <label for="{{$items->id_size}}">{{$items->size_name}}</label>
                            <input type="checkbox"
                                   class="form-check-inline" id="{{$items->id_size}}" value="{{$items->id_size}}" name="sizes[]">
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputPassword4" >Mô tả</label>
                       <textarea class="form-control col-md-12" style="height: 150px" name="context" id="inputPassword4"
                                required="" placeholder="Nhập mô tả sản phẩm..."></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-box btn-primary btn-block" >Thêm mới</button>
            </div>
        </form>
    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('.admin_layout.script')
</body>
</html>
