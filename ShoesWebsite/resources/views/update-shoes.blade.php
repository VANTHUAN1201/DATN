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
        @foreach($chitiet as $item)
            <form action="{{route('shoe.update',$item->id_shoes)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div>
                    <h1>Chỉnh sửa sản phẩm</h1>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Tên sản phẩm</label>
                            <input type="text" class="form-control"
                                   value="{{$item->shoes_name}}" required="" id="inputEmail4" placeholder="Name"
                                   name="shoesname">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Danh mục</label>
                            <select id="inputState" class="form-control" name="id_category">
                                @foreach($category as $items)
                                    <option  value="{{$items->id_category}}"
                                            @if($items->id_category == $item->id_category) selected @endif>{{$items->category_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Thương hiệu</label>
                            <select id="inputState" class="form-control" name="id_brand">
                                @foreach($brand as $item2)
                                    <option  value="{{$item2->id_brand}}"
                                            @if($item2->id_brand ==$item->id_brand)
                                                selected
                                        @endif>{{$item2->brandname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Giá nhập</label>
                            <input type="number" class="form-control" id="inputPassword4"
                                   value="{{$item->prices_buy}}" required="" placeholder="vnd" name="prices_buy">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Giá bán</label>
                            <input type="number" class="form-control"
                                   value="{{$item->prices_sell}}" required="" id="inputPassword4" placeholder="vnd"
                                   name="prices_sell">
                        </div>
                        @if(($item->images)!=NULL)
                            <div class="form-group col-md-1">
                                <td><img src="{{$item->images}}" style="max-width: 100px;max-height: 100px"></td>
                            </div>
                        @endif
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Ảnh nổi bật</label>
                            <input type="file" class="form-control"
                                   value="{{$item->images}}" id="inputPassword4" name="file">
                        </div>
                        @foreach($images as $img)
                            @if(($img->image->images)!=NULL)

                                <div class="form-group col-md-1">
                                    <td><img src="{{$img->image->images}}" style="max-width: 100px;max-height: 100px">
                                    </td>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Ảnh chi tiết</label>
                            <input type="file" class="form-control"
                                   value="{{$img->image->images}}" id="inputPassword4" name="files[]"
                                   multiple="multiple">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Số lượng</label>
                            <input type="number" class="form-control"
                                   value="{{$item->quantity}}" required="" id="inputPassword4" name="quantity">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Tiêu đề</label>
                            <input type="text" class="form-control"
                                   value="{{$item->title}}" required="" id="inputPassword4" name="title"
                                   placeholder="Tiêu đề">
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="form-group">Màu </label>
                        <div class="form-group col-md-12">
                            @foreach($color as $colors)

                                    <label class="form-group" for="{{$colors->id_color}}">
                                        {{$colors->color_name}}
                                    </label>
                                    <input class="form-check-inline" type="checkbox" id="{{$colors->id_color}}"
                                           value="{{$colors->id_color}}"@foreach($shoecolor as $key)
                                           @if($colors->color_name == $key->color->color_name) checked
                                           @endif  @endforeach name="colors[]">

                            @endforeach
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="form-group">Kích thước</label>
                        <div class="form-group col-md-12">
                            @foreach($size as $sizes)
                                <label for="{{$sizes->id_size}}">{{$sizes->size_name}}</label>
                                <input type="checkbox"
                                       class="form-check-inline" id="{{$sizes->id_size}}" value="{{$sizes->id_size}}"
                                       @foreach($shoesize as $key)
                                           @if($sizes->size_name == $key->size->size_name) checked @endif
                                       @endforeach name="sizes[]">
                            @endforeach
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Mô tả</label>
                            <textarea class="form-control col-md-12" style="height: 150px" name="context"
                                      id="inputPassword4"
                                      required="" placeholder="Nhập mô tả ..">{{$item->context}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-box btn-primary btn-block">Cập nhật</button>
                </div>
            </form>
        @endforeach

    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('.admin_layout.script')
</body>
</html>
