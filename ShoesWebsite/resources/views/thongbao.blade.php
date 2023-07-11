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
                    <p class="bread"><span><a href="{{\Illuminate\Support\Facades\URL::to('home')}}">Trang chủ</a></span> / <span>Giỏ hàng</span></p>
                </div>
            </div>
        </div>
    </div>

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

    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-sm-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Cập nhật giỏ hàng</h3>
                        </div>
                        <div class="process text-center active">
                            <p><span>02</span></p>
                            <h3>Cập nhật thông tin đơn hàng</h3>
                        </div>
                        <div class="process text-center active">
                            <p><span>03</span></p>
                            <h3>Đặt hàng</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 offset-sm-1 text-center">
                    <p class="icon-addcart"><span><i class="icon-check"></i></span></p>
                    <h2 class="mb-4">Cảm ơn bạn đã mua hàng, Đơn hàng của bạn đã hoàn tất</h2>
                    <p>
                        <a href="{{\Illuminate\Support\Facades\URL::to('/')}}" class="btn btn-primary btn-outline-primary">Trang chủ</a>
                        <a href="{{\Illuminate\Support\Facades\URL::to('sanpham')}}" class="btn btn-primary btn-outline-primary">
                            <i class="icon-shopping-cart"></i> Tiếp tục mua hàng</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

  @include('.layout.footer')
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
</div>

@include('.layout.script')
</body>
</html>

