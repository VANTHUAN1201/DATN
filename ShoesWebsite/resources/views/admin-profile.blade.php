<!doctype html>
<html lang="en">
@include('.admin_layout.header')
<body class="vertical  light  ">
<div class="wrapper">
    @include('.admin_layout.nav')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    @foreach($user as $item)
                        <h2 class="h3 mb-4 page-title">Tài khoản</h2>
                        <div class="row mt-5 align-items-center">
                            <div class="col-md-3 text-center mb-5">
                                <div class="avatar avatar-xl">
                                    <img src="{{$item->images}}" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">{{$item->user_name}}</h4>
                                        <p>Địa chỉ : {{$item->address}}</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-7">
                                        <p><i class="icon icon-at-sign"></i>Email : {{$item->email}}</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p class="">Số điện thoại : {{$item->phone}}</p>
                                    </div>
                                    <div class="col-md-7">
                                        <a class="btn btn-primary" href="" style="margin-top: 20px">Cập nhật</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- /.col-12 -->
            </div> <!-- .row -->
        </div>
    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('.admin_layout.script')
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
</body>
</html>
