<!doctype html>
<html lang="en">
@include('.admin_layout.header')

<body class="vertical  light  ">
<div class="wrapper">
    @include('.admin_layout.nav')
    <main role="main" class="main-content">
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
        @foreach($oder as $key)
                <h1 class="text-center form-control text-dark-dark" style="font-size: 30px">Cập nhật đơn hàng</h1>
            @foreach($oders as $item)
                <div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Tên sản phẩm</label>
                            <input type="text" class="form-control" readonly
                                   value="{{$item->shoes_name}}" required="" id="inputEmail4" placeholder="Name">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputEmail4">Màu</label>
                            <input type="text" class="form-control" readonly
                                   value="{{$item->color}}" required="" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputEmail4">Kích thước</label>
                            <input type="text" class="form-control" readonly
                                   value="{{$item->size}}" required="" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Số lượng</label>
                            <input type="number" class="form-control" readonly
                                   value="{{$item->quantity}}" required="" id="inputPassword4" name="quantity">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Giá</label>
                            <input type="number" class="form-control" readonly
                                   value="{{$item->prices_sell}}" required="" id="inputPassword4" name="quantity">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Tiền</label>
                            <input type="number" class="form-control" readonly
                                   value="{{$item->quantity * $item->prices_sell}}" required="" id="inputEmail4"
                                   name="shoesname">
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
               
                @php
                    $id_us=\Illuminate\Support\Facades\DB::table('oders')->where('id_oders','=',$key->id_oders)->get()->value('id_user');
                    $user=\Illuminate\Support\Facades\DB::table('users')->where('id_user',$id_us)->get();
                @endphp
                @foreach($user as $users)
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Tên người nhận</label>
                        <input type="text" class="form-control" readonly
                               value="{{$users->user_name}}" required="" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Địa chỉ nhận hàng</label>
                        <input type="text" class="form-control" readonly
                               value="{{$users->address}}" required="" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Số điện thoại</label>
                        <input type="text" class="form-control" readonly
                               value="{{$users->phone}}" required="" id="inputEmail4">
                    </div>
                @endforeach
                <div class="form-group col-md-2">
                    <label for="inputEmail4">Tổng tiền </label>
                    <input type="number" class="form-control" readonly
                           value="{{$key->sub_total}}" required="" id="inputEmail4">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <form action="{{route('update-oder-status',$item->id_oders)}}" method="post">
                        @csrf
                        @method('patch')
                        <label for="inputEmail4">Oder Status</label>
                        <select id="inputState" class="form-control" name="status">
                            <option selected value="0" @if($item->status == 0)
                                selected="selected"
                                @endif>Chờ xử lý</option>
                            <option selected value="1" @if($item->status == 1)
                                selected="selected"
                                @endif>Đang giao</option>
                            <option selected value="2" @if($item->status == 2)
                                selected="selected"
                                @endif>Hoàn thành</option>
                        </select>
                        <button style="margin-top: 10px" type="submit" class="btn  btn-primary btn-block">Cập nhật đơn hàng</button>
                    </form>
                </div>
            </div>
        @endforeach

    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('.admin_layout.script')
</body>
</html>
