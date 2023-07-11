<!doctype html>
<html lang="en">
@include('.admin_layout.header')
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
<body class="light ">
<div class="wrapper vh-100">
    <div class="row align-items-center h-100">

        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" action="{{route('login')}}" method="POST">
            @csrf
            <img src="/client/images/logo.png"  alt="logo" style="margin-bottom: 30%; margin-top: 10%;">
            <h2 >Đăng nhập</h2>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Tài khoản gmail</label>
                <input type="email" id="inputEmail" name="email"
                       class="form-control form-control-lg" placeholder="Nhập gmail..." required="" autofocus="">
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Mật khẩu</label>
                <input type="password" id="inputPassword" name="password"
                       class="form-control form-control-lg" placeholder="mật khẩu.." required="">
            </div>
            <div class="checkbox mb-3">
                <label><a href="{{\Illuminate\Support\Facades\URL::to('register')}}">Đăng ký  <i class="fe fe-arrow-right"></i></a></label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit"> <i class="fe fe-log-in"></i> Đăng nhập</button>
        </form>
    </div>
</div>
{{--<script src="../../public/js/jquery.min.js"></script>--}}
{{--<script src="../../public/js/popper.min.js"></script>--}}
{{--<script src="../../public/js/moment.min.js"></script>--}}
{{--<script src="../../public/js/bootstrap.min.js"></script>--}}
{{--<script src="../../public/js/simplebar.min.js"></script>--}}
{{--<script src='../../public/js/daterangepicker.js'></script>--}}
{{--<script src='../../public/js/jquery.stickOnScroll.js'></script>--}}
{{--<script src="../../public/js/tinycolor-min.js"></script>--}}
{{--<script src="../../public/js/config.js"></script>--}}
{{--<script src="../../public/js/apps.js"></script>--}}
<!-- Global site tag (gtag.js) - Google Analytics -->
@include('.admin_layout.script')
</body>
</html>
</body>
</html>
