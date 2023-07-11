<!DOCTYPE HTML>
<html>
@include('.layout.header')
<body>
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
<div class="colorlib-loader"></div>

<div id="page">
    @include('.layout.nav')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="{{\Illuminate\Support\Facades\URL::to('home')}}">Trang chủ</a></span> /
                        <span>Chi tiết sản phẩm</span></p>
                </div>
            </div>
        </div>
    </div>
    @foreach($chitiet as $item)

        <div class="colorlib-product">
            <div class="container">
                <div class="row row-pb-lg product-detail-wrap">
                    <div class="col-sm-8">
                        <div class="owl-carousel">
                            @foreach($images as $image)
                                <div class="item">
                                    <div class="product-entry border">
                                        <a href="#" class="prod-img">
                                            <img src="{{$image->image->images}}" width="300px" height="400px"
                                                 alt="" >
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-desc">
                            <h3>{{$item->shoes_name}}</h3>
                            <p class="price">
                               <p>Giá: <span style="color: red;">{{$item->prices_sell}} vnd</span></p>
                            </p>
                            <p class="form-label">Số lượng: <span style="color: red;">{{$item->quantity}}</span></p>
                            <p>Mô tả:</p>
                            <p>{{$item->context}}</p>
                            <div class="form-row">
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#addToCartModal">
                                         Thêm giỏ hàng <span><i class="icon icon-shopping-cart text-light" ></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button to trigger the modal -->
                <!-- Modal -->
                <div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog"
                     aria-labelledby="addToCartModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addToCartModalLabel">Thêm giỏ hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form to add item to cart -->
                                <form method="POST" action="{{route('cart.store')}}">
                                    @csrf
                                    <input type="hidden" name="id_shoes" value="{{$item->id_shoes}}">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{$item->images}}" style="max-width: 150px;max-height: 150px">
                                            </div>
                                            <div class="col-md-8">
                                                <h4 class="text-center"> {{$item->shoes_name}}</h4>
                                                <p class="text-info text-center">Giá : {{$item->prices_sell}} vnd</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Màu :</label>
                                        <select class="form-control"  id="color" name="color">
                                            @foreach($color as $colors)
                                                <option selected
                                                        value="{{$colors->color->color_name}}">{{$colors->color->color_name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="size">Size:</label>
                                        <select class="form-control" id="size" name="size">
                                            @foreach($size as $sizes)
                                                <option
                                                    value="{{ $sizes->size->size_name}}">{{ $sizes->size->size_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="quantity">Số lượng</label>
                                    <div class="input-group mb-4">
{{--                                        <span class="input-group-btn">--}}
{{--                                                <button type="button" class="quantity-left-minus btn" data-type="minus"--}}
{{--                                                        data-field=""><i class="icon-minus2"></i></button>--}}
{{--                                        </span>--}}
                                            <input type="number" id="quantity" name="quantity"
                                                   class="form-control" min="1" max="{{$item->quantity}}"
                                                    value="1" required="numberic">
{{--                                            <span class="input-group-btn ml-1">--}}
{{--                                            <button type="button" class="quantity-right-plus btn" data-type="plus"--}}
{{--                                                    data-field=""><i class="icon-plus2"></i></button></span>--}}
                                    </div>
                                    <!-- Other fields and inputs -->
                                    <!-- Add any additional form inputs here -->
                                    <button type="submit" class="btn btn-primary">Thêm giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @include('.layout.footer')
</div>

@include('.layout.script')

<script>
    $(document).ready(function () {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function (e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });

    });
</script>


</body>
</html>

