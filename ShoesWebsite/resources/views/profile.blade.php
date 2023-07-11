<!DOCTYPE html>
<html lang="en">
@include('.layout.header')
<body>
@include('.layout.nav')
@foreach($user as $item)
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thông tin tài khoản</h5>
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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if(($item->images)!=null)
                            <img src="{{$item->images}}" alt="Profile Picture" class="img-fluid rounded-circle">
                        @else
                            <form action="{{route('avatar',$item->id_user)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="file" class="form-control"
                                       required="" name="image">
                                <button style="margin-top: 20px" class="btn btn-primary text-center"><i class="icon icon-upload-cloud">
                                    </i>Tải ảnh lên</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">{{$item->user_name}}</h5>
                        <p class="card-text">Email : {{$item->email}}</p>
                        <p class="card-text">Số điện thoại{{$item->phone}}</p>
                        <p class="card-text">Địa chỉ : {{$item->address}}</p>
                        <!-- <p class="card-text">Role : @if($item->role==0) Client @else Admin @endif</p> -->
                        <a href="{{\Illuminate\Support\Facades\URL::to('update-user',$item->id_user)}}" class="btn btn-primary">Cập nhật tài khoản</a>
                        <a class="btn btn-primary" href="{{\Illuminate\Support\Facades\URL::to('logout')}}"><span class="fe-log-out">Đăng xuất</span></a>
                    </div>
                </div>
                <div class="row">
                    <!-- <h2 class="form-control">Thông tin đơn hàng</h2> -->
                    <div class="form-group">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@include('.layout.footer')
@include('.layout.script')
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
