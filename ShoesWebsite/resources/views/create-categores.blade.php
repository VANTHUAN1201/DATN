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
        <form action="{{route('category.store')}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-left: 20%">
                <h1>Thêm mới danh mục</h1>
                <div class="form-row">
                    <div class="form-group col-md-6" style="margin-top: 10px">
                        <label for="inputEmail4">Tên danh mục</label>
                        <input type="text" class="form-control text-center"
                               required="" id="inputEmail4" placeholder="Nhập tên danh mục..." name="category_name">
                    </div>
                </div>
                <button type="submit" class="btn btn-box btn-primary" >Thêm mới</button>
            </div>
        </form>
    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('.admin_layout.script')
</body>
</html>
