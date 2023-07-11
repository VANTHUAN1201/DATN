<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
@include('.layout.header')
<body>
<div class="colorlib-loader"></div>
<div id="page">
    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if ($message = \Illuminate\Support\Facades\Session::get('error'))
        <div class="alert alert-danger alert-danger" style="text-align: center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = \Illuminate\Support\Facades\Session::get('message'))
        <div class="alert alert-success alert-success" style="text-align: center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong style="text-align: center">{{ $message }}</strong>
        </div>
    @endif
    @include('.layout.nav')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="{{\Illuminate\Support\Facades\URL::to('/')}}">Trang chủ</a></span> /
                        <span>Giỏ hàng</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-md-10 offset-md-1">
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
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Cập nhật giỏ hàng</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>02</span></p>
                            <h3>Cập nhật thông tin đơn hàng</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Đặt hàng</h3>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table">
                <div class="row">
                    <div class="col-md-12">
                        <div>

                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Giá</th>
                                <th class="text-center">Màu </th>
                                <th class="text-center">Kích thước</th>
                                <th class="text-center">Số Lượng</th>
                                <th class="text-center">Tổng tiền</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($cart as $item)
                                <tr>
                                    @php
                                        $id_details=DB::table('details_shoes')->where('id_shoes',$item->id_shoes)->get()->value('id_details_shoes');
                                        $size=\App\Models\DetailsSizeShoe::with('size')->where( 'id_details_shoes',$id_details)->get();
                                        $color=\App\Models\DetailsColorShoe::with('color')->where('id_details_shoes',$id_details)->get();
                                        $getquantity=DB::table('details_shoes')->where('id_details_shoes',$id_details)->get()->value('quantity');
                                    @endphp
                                    <td style="max-width: 100px"><img src="{{$item->images}}"
                                                                      style="max-height: 100px;max-width: 100px">
                                    </td>
                                    <td style="max-width: 150px">{{$item->shoes_name}}</td>
                                    <td class="text-center">{{$item->prices_sell}} vnd</td>
                                    <form method="POST" action="{{route('cart.update',$item->id_carts)}}">
                                        @csrf
                                        @method('patch')
                                        <td>
                                            <select class="form-control" name="color">
                                                @foreach($color as $colors)
                                                    <option
                                                        value="{{$colors->color->color_name}}"
                                                        @if($item->color == $colors->color->color_name)
                                                            selected="selected"
                                                        @endif>{{$colors->color->color_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="size">
                                                @foreach($size as $sizes)
                                                    <option
                                                        value="{{$sizes->size->size_name}}"
                                                        @if($item->size == $sizes->size->size_name)
                                                            selected="selected"
                                                        @endif>{{$sizes->size->size_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="max-width: 100px">
                                            <input type="number" class="form-control" min="1" max="{{$getquantity}}"
                                                   name="quantity" value="{{$item->quantity}}">
                                        </td>
                                        <td class="text-center" style="max-width: 50px">
                                            {{($item->quantity)*$item->prices_sell}} vnd
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" type="submit">Cập nhật
                                            </button>
                                    </form>
                                    <form action="{{route('cart.destroy',$item->id_carts)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-primary" type="submit">Xóa</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </div>
                    </div>
                </div>
            </table>
            <div class="row">
                <div class="form-group col-md-10">
                <a href="{{\Illuminate\Support\Facades\URL::to('sanpham')}}" class="btn btn-primary btn-outline-primary">
                            <i class="icon-shopping-cart"></i> Tiếp tục mua hàng</a>
                
                </div>
                
                <div class="form-group col-md-2">
                
                    <a href="{{\Illuminate\Support\Facades\URL::to('dathang')}}" class="btn btn-primary">
                       <i class="icon-credit-card"></i>  Đặt hàng</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
            <div class="row">
                @foreach($shoes as $item)
                    <div class="col-md-3 col-lg-3 mb-4 text-center">
                        <div class="product-entry border">
                            <a href="{{\Illuminate\Support\Facades\URL::to('chitiet',$item->id_shoes)}}"
                               class="prod-img">
                                <img src="{{$item->images}}" class="img-fluid"
                                     alt="..">
                            </a>
                            <div class="desc">
                                <h2><a href="#">{{$item->shoes_name}}</a></h2>
                                <span class="price">{{$item->prices_sell}} vnd</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    @include('.layout.footer')
</div>
<!-- jQuery -->
@include('.layout.script')
</body>
</html>

