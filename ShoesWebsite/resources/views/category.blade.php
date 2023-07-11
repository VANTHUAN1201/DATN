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
                    <span class="mb-2 page-title" style="font-size: 20px">Danh mục</span>
                    <span class="mb-2 page-title" style="float: right;font-size: 20px"><a class=" btn btn-primary" href="{{\Illuminate\Support\Facades\URL::to('admin/category-create')}}">Thêm mới</a></span>
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
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Tên danh mục</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($category as $item)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>{{$item->id_category}}</td>
                                                <td>{{$item->category_name}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button type="submit" style="border:none;background: none">
                                                            <a class="dropdown-item" href="{{\Illuminate\Support\Facades\URL::to('admin/update-category',$item->id_category)}}">
                                                                <i class="icon-trash-2"></i>Chỉnh sửa</a>
                                                        </button>
                                                        <form action="{{route('category.destroy',$item->id_category)}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" style="border:none;background: none">
                                                                <p class="dropdown-item"><i class="icon-trash-2"></i>Xóa</p>
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
