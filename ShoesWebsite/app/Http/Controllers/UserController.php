<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Oder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // trả về tất cả user không phải là admin
        $user=User::all()->where('role','=',0);
        return view('user',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return  view('',compact());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check=User::all()->where('user_name',$request->username)->first();
        if(is_null($check))
        {
            User::create(
                [
                    'user_name'=>$request->username,
                    'password'=>bcrypt($request->password),
                    'email'=>$request->email,
                    'role'=>'0'
                ]
            );
            return redirect()->back()->with('message','Đăng ký thành công!');
        }
        else{
            return redirect()->back()->with('error','Tài khoản đã tồn tại !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user=User::all()->where('id_user',$id);
        return view('update-user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $id_us=Auth::user()->id_user;
        $ten_us=DB::table('users')->where('id_user',$id_us)->get()->value('username');
        $check=DB::table('users')->where('email',$request->email)
            ->where('id_user','!=',$id_us)->get()->first();
        if(is_null($check))
        {
//            if($image=$request->file('file'))
//            {
//                $destinationPath = 'images/';
//                $profileImage = date('YmdHis') . "." . $image->getClientOriginalName();
//                $image->move($destinationPath, $profileImage);
//                $data = "http://127.0.0.1:8000/images/$profileImage";
//            }
            DB::table('users')->where('id_user',$id)->update([
                'user_name'=>$request->username,
                'phone'=>$request->phone,
//                'images'=>$data,
                'email'=>$request->email,
                'address'=>$request->address,
            ]);
            return redirect()->back()->with('message','Cập nhật thành công');
        }else{
            return redirect()->back()->with('error','Địa chỉ email đã được sử dụng!');
        }
    }
    public function profile($id)
    {
        $user=User::all()->where('id_user',$id);
        return view('profile',compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check=Oder::all()->where('id_user',$id)->first();

        $check2=Cart::all()->where('id_users',$id)->first();
        if (is_null($check))
        {
            if (is_null($check2))
            {
                User::destroy($id);
                return redirect()->back()->with('message','Xóa tài khoản thành công');
            }else{
                return redirect()->back()->with('error','Tài khoản có sản phẩm trong giỏ hàng, không thể xóa!');
            }
        }
        else{
            return redirect()->back()->with('error','Tài khoản có đặt hàng, không thể xóa!');
        }
    }
    public function login(Request $request)
    {
        $login=[
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($login)){
            $id_us=Auth::user()->id_user;
            $get_role=DB::table('users')->where('id_user',$id_us)->get()->value('role');
            if ($get_role==1)
            {
                return redirect('admin/administrator')->with('message','ĐĂng nhập ADMIN thành công!');
            }else{
                return redirect('/')->with('message','Đăng nhập thành công!');
            }
        }else{
            return redirect()->back()->with('error','Nhập sai email hoặc mật khẩu!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('message','Đăng xuất thành công!');
    }
    public function uploadimg(Request $request,$id)
    {
        if($image=$request->file('image'))
        {
            $destinationPath = 'images/';
            $profileImage = $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $data = "http://127.0.0.1:8000/images/$profileImage";
            DB::table('users')->where('id_user',$id)->update([
               'images'=>$data
            ]);
            return redirect()->back()->with('message','Tải ảnh thành công!');
        }
        else
        {
            return redirect()->back()->with('error',' Tải ảnh lên thất bại');
        }
    }
    public function clientupdate(Request $request,$id)
    {
        $check=DB::table('users')->where('email',$request->email)
            ->where('id_user','!=',$id)->get()->first();
        $user=User::all()->where('id_user',$id);
        if(is_null($check))
        {
            foreach ($user as $key)
            {
                if($image=$request->file('file'))
                {

                    $destinationPath = 'images/';
                    $profileImage = $image->getClientOriginalName();
                    $image->move($destinationPath, $profileImage);
                    $data = "http://127.0.0.1:8000/images/$profileImage";
                }
                else{
                    $data=$key->images;
                }
            }
            DB::table('users')->where('id_user',$id)->update([
                'user_name'=>$request->username,
                'phone'=>$request->phone,
                'images'=>$data,
                'email'=>$request->email,
                'address'=>$request->address,
            ]);
            return redirect()->back()->with('message','Cập nhật thành công!');
        }else{
            return redirect()->back()->with('error','Địa chỉ email đã được sử dụng!');
        }
    }
}
