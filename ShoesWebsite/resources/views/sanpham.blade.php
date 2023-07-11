<!DOCTYPE HTML>
<html>
@include('.layout.header')
<body>
<div class="colorlib-loader"></div>
<div id="page">
   @include('.layout.nav')

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="{{\Illuminate\Support\Facades\URL::to('/')}}">Trang chủ</a></span> / <span>Sản phẩm</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="breadcrumbs-two">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs-img" style="background-image: url(client/images/banner2.jpg);">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="colorlib-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xl-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Thương hiệu</h3>
                                <ul>
                                    @foreach($brand as $item)
                                        <li><a href='{{\Illuminate\Support\Facades\URL::to("/sanpham?brand=$item->id_brand")}}'>{{$item->brandname}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Giá</h3>
                                <ul>
                                    <li><a href="#">Tất cả</a></li>
                                    <li><a href="#">0 VND ~ 500.000 VND</a></li>
                                    <li><a href="#">500.000 VND ~ 1.000.000 VND </a></li>
                                    <li><a href="#">1.000.000 VND ~ 1.500.000 VND</a></li>
                                    <li><a href="#">1.500.000 VND ~ 2.000.000 VND</a></li>
                                    <li><a href="#">Trên 2.000.000 VND</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="side border mb-1">
                                <h3>Kích thước</h3>
                                <div class="block-26 mb-2">
                                    <ul>
                                        @foreach($size as $item) <li><a href="#">{{$item->size_name}}</a></li> @endforeach

                                    </ul>
                                </div>
                                <div class="block-26">
                                    <h4>Màu</h4>
                                    <ul> @foreach($color as $item)
                                            <li><a href="#">{{$item->color_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-xl-9">
                    <div class="row row-pb-md" >
                        @foreach($shoe as $item)
                            @if(isset($_REQUEST['brand']))
                                @if($item->id_brand == $_REQUEST['brand'])
                                    <div class="col-lg-4 mb-4 text-center">
                                        <div class="product-entry border">
                                            <a href="{{\Illuminate\Support\Facades\URL::to('chitiet',$item->id_shoes)}}" class="prod-img">
                                                <img src="{{$item->images}}" class="img-fluid" alt="...">
                                            </a>
                                            <div class="desc">
                                                <h2><a href="{{\Illuminate\Support\Facades\URL::to('chitiet',$item->id_shoes)}}">{{$item->shoes_name}}</a></h2>
                                                <span class="price" style="color: red;">{{$item->prices_sell}} vnd</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="col-lg-4 mb-4 text-center">
                                    <div class="product-entry border">
                                        <a href="{{\Illuminate\Support\Facades\URL::to('chitiet',$item->id_shoes)}}" class="prod-img">
                                            <img src="{{$item->images}}" class="img-fluid" alt="...">
                                        </a>
                                        <div class="desc">
                                            <h2><a href="{{\Illuminate\Support\Facades\URL::to('chitiet',$item->id_shoes)}}">{{$item->shoes_name}}</a></h2>
                                            <span class="price" style="color: red;">{{$item->prices_sell}} vnd</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="block-27">
                                <ul>
                                    <li><a href="#"><i class="ion-ios-arrow-back"></i></a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#"><i class="ion-ios-arrow-forward"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-partner">
        <div class="container">
            <div class="row">
                <div class="col partner-col text-center">
                    <img src="/client/images/brand-1.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="/client/images/brand-2.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="/client/images/brand-3.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="/client/images/brand-4.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="/client/images/brand-5.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
            </div>
        </div>
    </div>

    @include('.layout.footer')
</div>
@include('.layout.script')

</body>
</html>

