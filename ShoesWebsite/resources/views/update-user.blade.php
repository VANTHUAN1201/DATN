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
                <div class="row form-group">
                    <form action="{{\Illuminate\Support\Facades\URL::to('client-update',$item->id_user)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="col-md-4" style="position: absolute">
                            @if(($item->images)!=null)
                                <div class="form-group">
                                    <img src="{{$item->images}}" class="img-fluid rounded-circle">
                                </div>
                            @endif
                            <input type="file" name="file"value="{{$item->images}}">
                        </div>
                        <div class="col-md-7" style="float: right">
                            <div class="card-title">
                                <label class="text-black-50">Tên tài khoản</label>
                                <input type="text" class="form-control" name="username" value="{{$item->user_name}}" required="">
                            </div>
                            <div class="card-title">
                                <label class="text-black-50">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{$item->phone}}" required="">
                            </div>
                            <div class="card-title">
                                <label class="text-black-50">Email</label>
                                <input type="text" class="form-control" name="email" value="{{$item->email}}" required="">
                            </div>
                            <div class="card-title" >
                                <label class="text-black-50">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" value="{{$item->address}}" required="">
                            </div>
                            <div >
                                <button type="submit" class="btn btn-primary"><i class="fe fe-upload"></i>Cập nhật</button>
                            </div>
                        </div>
                    </form>
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
