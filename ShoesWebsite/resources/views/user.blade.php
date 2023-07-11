{{--@if((\Illuminate\Support\Facades\Auth::user()->role)==0)--}}
{{--    @php return redirect('login'); @endphp--}}
{{--@endif--}}
<!doctype html>
<html lang="en">
@include('.admin_layout.header')
<body class="vertical  light  ">
<div class="wrapper">
    @include('.admin_layout.nav')
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
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <span class="mb-2 page-title" style="font-size: 20px">Danh sách người dùng</span>
                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>SDT</th>
                                            <th>Email</th>
                                            <th>Hình ảnh</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày tạo</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user as $item)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>{{$item->id_user}}</td>
                                                <td>{{$item->user_name}}</td>
                                                <td>{{$item->phone}}</td>
                                                <td>{{$item->email}}</td>
                                                <td><img src="{{$item->images}}" style="max-width: 100px;max-height: 100px"></td>
                                                <td>{{$item->address}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Xem thông tin</a>
                                                        <form action="{{route('deleteuser',$item->id_user)}}"  method="POST" >
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" style="border: none;background: none" >
                                                                <a class="dropdown-item">Xóa</a>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- simple table -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('.admin_layout.script')
</body>
</html>
