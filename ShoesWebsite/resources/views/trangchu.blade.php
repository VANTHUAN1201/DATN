<!DOCTYPE HTML>
<html>
@include('.layout.header')
<body>

<div class="colorlib-loader"></div>

<div id="page">
    @include('.layout.nav')

    <div class="colorlib-product">
        <div class="container">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="1200">
                        <img src="/client/images/banner4.jpg" class="d-block w-100" alt="..." style=" max-height: 938px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
            </div>
            <div class="row row-pb-md">
                @foreach($shoe as $item)
                    <div class="col-lg-3 mb-4 text-center">
                        <div class="product-entry border">
                            <a href="{{\Illuminate\Support\Facades\URL::to('chitiet',$item->id_shoes)}}" class="prod-img">
                                <img src="{{$item->images}}" class="img-fluid" alt="..">
                            </a>
                            <div class="desc">
                                <h2><a href="{{\Illuminate\Support\Facades\URL::to('chitiet',$item->id_shoes)}}">{{$item->shoes_name}}</a></h2>
                                <span class="price" style="color: red;">{{$item->prices_sell}} vnd</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p><a href="{{\Illuminate\Support\Facades\URL::to('sanpham')}}" class="btn btn-primary btn-lg">Tất cả sản phẩm</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-partner">
        <div class="container">
            <div class="row">
                <div class="col partner-col text-center">
                    <img src="client/images/brand-1.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="client/images/brand-2.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="client/images/brand-3.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="client/images/brand-4.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="client/images/brand-5.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
            </div>
        </div>
    </div>

@include('.layout.footer')
</div>

@include('.layout.script')

</body>
</html>

