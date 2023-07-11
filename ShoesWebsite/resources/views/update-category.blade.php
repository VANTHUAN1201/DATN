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
        @foreach($category as $key)
            <form action="{{route('category.update',$key->id_category)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group" style="margin-left: 20%">
                    <h1>Cập nhật danh mục</h1>
                    <div class="form-row">
                        <div class="form-group col-md-6" style="margin-top: 10px">
                            <label for="inputEmail4">Tên danh mục</label>
                            <input type="text" class="form-control"
                                  value="{{$key->category_name}}" required="" id="inputEmail4"  name="category_name">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-box btn-primary">Cập nhật</button>
                </div>
            </form>
        @endforeach

    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('.admin_layout.script')
</body>
</html>
