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
                    <span class="mb-2 page-title" style="font-size: 20px">Danh sách đơn hàng</span>
                    <span class="mb-2 page-title" style="float: right;font-size: 20px"><a class=" btn btn-primary" href="">Thêm mới</a></span>
                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
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
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Tên người nhận</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ nhận hàng</th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($oder as $item)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>{{$item->id_oders}}</td>
                                                <td>{{$item->user_name}}</td>
                                                <td>{{$item->phone}}</td>
                                                <td>{{$item->address}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>{{$item->sub_total}}</td>
                                                <td><span class="dot dot-lg bg-warning mr-2"></span>@if(($item->status)==0)
                                                        Chờ xử lý
                                                @else 
                                                @if(($item->status)==1)
                                                        Đang giao
                                                    @else 
                                                        Hoàn thành                         
                                                    @endif
                                                @endif
                                                </td>

                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Tùy chọn
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                            <button type="submit" style="border: none;background: none" >
                                                                <p class="dropdown-item"><a href="{{\Illuminate\Support\Facades\URL::to('admin/update-oder',$item->id_oders)}}">Duyệt</a></p>
                                                            </button>

                                                        <form action="{{route('oder.destroy',$item->id_oders)}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" style="border: none;background: none" >
                                                                <p class="dropdown-item">Xóa</p>
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
