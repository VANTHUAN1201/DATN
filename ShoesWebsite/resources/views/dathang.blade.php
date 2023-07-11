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
                    <p class="bread"><span><a href="{{\Illuminate\Support\Facades\URL::to('home')}}">Trang chủ</a></span> /
                        <span>Đặt hàng</span></p>
                </div>
            </div>
        </div>
    </div>
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
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Đặt hàng</h3>
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
            <div class="row">
                <div class="col-lg-8">
                    @foreach($user as $item)
                        <form method="post" class="colorlib-form" action="{{route('capnhatuser',$item->id_user)}}">
                            @csrf

                            <h2>Thông tin đơn hàng</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Tên người nhận</label>
                                        <input type="text" id="fname" name="username" class="form-control"
                                               value="{{$item->user_name}}" placeholder="Your firstname">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Địa chỉ</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                               required="" value="{{$item->address}}" placeholder="Enter Your Address">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" ></label>
                                        <input type="hidden" id="email" name="email"
                                               value="{{$item->email}}" required="" class="form-control"
                                               placeholder="State Province">
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">Số điện thoại :</label>
                                            <input type="tel" id="password" name="phone" class="form-control" value="{{$item->phone}}"
                                                   minlength="9" maxlength="9">
                                            <span id="passwordError" style="color: red;"></span>
                                        </div>
                                </div>
                                <script>
                                    const passwordInput = document.getElementById("password");
                                    const passwordError = document.getElementById("passwordError");
                                    passwordInput.addEventListener("input", function() {
                                        if(isNaN(passwordInput.value))
                                        {
                                            passwordError.textContent = "Nhập số!";
                                        }
                                        else if (passwordInput.value.length < 10) {
                                            passwordError.textContent = "Phải nhập đủ 9 số ";
                                        }
                                        else if (passwordInput.value.length >10) {
                                            passwordError.textContent = "Phải nhập đủ 9 số";
                                        } else {
                                            passwordError.textContent = "";
                                        }
                                    });
                                </script>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-primary"  id="validateBtn"><i class="icon icon-arrow-repeat"></i> 
                                            Cập nhật thông tin
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
                <div class="col-lg-4">
                    <form method="POST" action="{{route('createoder')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cart-detail">
                                    <h2>Thông tin đơn hàng</h2>
                                    <ul>
                                        <li>
                                            <span>Tổng tiền</span> <span>{{$subtotal}} vnd</span>
                                            <ul>
                                                @foreach($cart as $item)
                                                    @php $total=$item->quantity*$item->prices_sell @endphp
                                                    <li><span>{{$item->quantity}} x {{$item->shoes_name}}</span><span>{{$total}} vnd</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><span>Vận chuyển</span> free ship<span></span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="cart-detail">
                                    <h2>Thanh toán | Vận chuyển</h2>
                                    <div class="form-group">
                                        <label for="payment">Thanh toán</label>
                                        @foreach($payment as $item)
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input required="" type="radio" name="id_payment"
                                                                  value="{{$item->id_payment}}"> {{$item->payment_name}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                        <label for="shipping">Vận chuyển</label>
                                        @foreach($delivery as $item)
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input required="" type="radio" name="id_delivery"
                                                                  value="{{$item->id_delivery}}"> {{$item->delivery_name}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="total" value="{{$subtotal}}">
                                    @php $vnd_to_usd=$subtotal/23033;
                                        $total_paypal=round($vnd_to_usd,2);
                                        \Illuminate\Support\Facades\Session::put('total_paypal',$total_paypal);
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary"><i class="icon icon-check-circle"></i> 
                                    Đặt hàng
                                </button>
            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('.layout.footer')
</div>

@include('.layout.script')

</body>
</html>

