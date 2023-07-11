<!doctype html>
<html lang="en">
@include('.admin_layout.header')
<body class="light ">
<div class="wrapper vh-100">
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
    <div class="row align-items-center h-100">
        <div class="mx-auto text-center my-4">
        <img src="/client/images/logo.png" class="img-fluid" alt="logo">
        
        </div>
        <form class="col-lg-6 col-md-8 col-10 mx-auto" method="POST" action="{{route('register')}}">
        <h2 class="my-3" style="text-align: center;">Đăng ký</h2>
            @csrf
            <div class="form-group">
                <label for="inputEmail4">Tài khoản gmail</label>
                <input type="email" name="email" required=""
                       placeholder="Nhập gmail.." class="form-control" id="inputEmail4">
            </div>
            <div class="form-group">
                <label for="firstname">Tên tài khoản</label>
                <input type="text" name="username" required=""
                       placeholder="Nhập tên tài khoản.. " id="firstname" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" class="form-control" required>
                <span id="passwordError" style="color: red;"></span>
            </div>
            <script>
                const passwordInput = document.getElementById("password");
                const passwordError = document.getElementById("passwordError");
                passwordInput.addEventListener("input", function() {
                    if (passwordInput.value.length < 7) {
                        passwordError.textContent = "Mật khẩu tối thiểu phải 7 kí tự";
                    } else {
                        passwordError.textContent = "";
                    }
                });
            </script>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng ký</button>
            <div class="form-group" style="margin-top: 20px">
                <p><a href="{{\Illuminate\Support\Facades\URL::to('login')}}"><i class="fe fe-arrow-left"></i>Trở về trang đăng nhập</a></p>
            </div>
        </form>
    </div>
</div>
@include('.admin_layout.script')
</body>
</html>
</body>
</html>
