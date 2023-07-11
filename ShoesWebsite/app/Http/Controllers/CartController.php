<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailsColorShoe;
use App\Models\DetailsSizeShoe;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shoes=DB::table('shoes')->where('shoes_name','LIKE','%giay%')->orderByDesc('created_at')->take(4)->get();
        $id_us=Auth::user()->id_user;
        $cart = DB::table('carts')->join('shoes','carts.id_shoes','=','shoes.id_shoes')
            ->where('id_users',$id_us)->get();
        return view('giohang', compact('cart','shoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id_us=Auth::user()->id_user;
        $check=DB::table('carts')->where('id_shoes',$request->id_shoes)
            ->where('color',$request->color)
            ->where('size',$request->size)
            ->where('id_users',$id_us)->get()->first();
        if(is_null($check))
        {
           $cart= Cart::create([
                'id_shoes'=>$request->id_shoes,
                'quantity'=>$request->quantity,
                'color'=>$request->color,
                'size'=>$request->size,
                'id_users'=>$id_us
            ]);
            return redirect()->back()->with('message','Thêm giỏ hàng thành công!');
        }
        else
        {
            $data= DB::table('carts')->where('id_shoes',$request->id_shoes)->select()->get()->value('quantity');
            DB::table('carts')->where('id_shoes',$request->id_shoes)->where('id_users',$id_us)
                ->update(['quantity'=>('1'+ 0)+ ($data+0)]);
            return redirect()->back()->with('message','Thêm giỏ hàng thành công!');
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
       DB::table('carts')->where('id_carts',$id)->update([
            'color'=>$request->color,
            'size'=>$request->size,
            'quantity'=>$request->quantity
        ]);

        return redirect()->back()->with('message','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cart::destroy($id);
        return redirect()->back()->with('message','Đã xóa sản phẩm!');

    }
}
