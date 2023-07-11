<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div id="colorlib-logo"><a href="{{\Illuminate\Support\Facades\URL::to('/')}}">
                        <img src="/client/images/logo.png" class="img-fluid" alt="logo">
                    </a></div>
                </div>
            </div>
            <div class="row form-group">
                <section class="ftco-section ftco-no-pb">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" name="country" id="country" placeholder="Tìm kiếm sản phẩm" class="form-control">
                                </div>
                                <div id="country_list"></div>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                </section>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#country').on('keyup',function() {
                            var query = $(this).val();
                            $.ajax({

                                url:"{{ route('search') }}",

                                type:"GET",

                                data:{'country':query},

                                success:function (data) {

                                    $('#country_list').html(data);
                                }
                            })
                            // end of ajax call
                        });
                        $(document).on('click', 'li', function(){
                            var value = $(this).text();
                            $('#country').val(value);
                            $('#country_list').html("");
                        });
                    });
                </script>
            </div>
            <div class="row">
                <div class="col-sm-12 text-left menu-1">
                    <ul>
                        <li class="active"><a href="{{\Illuminate\Support\Facades\URL::to('/')}}">Trang chủ</a></li>
                        <li><a href="{{\Illuminate\Support\Facades\URL::to('sanpham')}}">Sản phẩm</a></li>
                        <li><a href="#">Thông tin</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @php
                                $id=\Illuminate\Support\Facades\Auth::user()->id_user;
                                $name=\Illuminate\Support\Facades\Auth::user()->user_name;
                                $cart=\App\Models\Cart::all()->where('id_users',$id);
                                $count=count($cart);
                            @endphp
                            <li class="cart"><a href="{{\Illuminate\Support\Facades\URL::to('cart')}}"><i
                                        class="icon-shopping-cart"></i> Giỏ hàng [{{$count}}]</a></li>
                            <li style="float: right"><a href="{{\Illuminate\Support\Facades\URL::to('profile',$id)}}">
                                    <i class="icon-profile-male"></i>Tài khoản</a></li>
                        @else
                        
                            <li class="cart"><a href="{{\Illuminate\Support\Facades\URL::to('cart')}}"><i
                                        class="icon-shopping-cart"></i> Giỏ hàng [0]</a></li>
                            <li style="float: right"><a href="{{\Illuminate\Support\Facades\URL::to('register')}}">
                                    Đăng ký</a></li>
                            <li style="float: right"><a href="{{\Illuminate\Support\Facades\URL::to('login')}}">
                                    Đăng nhập</a></li>
                           
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
