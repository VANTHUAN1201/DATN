<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Delivery;
use App\Models\DetailsOder;
use App\Models\DetailsShoe;
use App\Models\Oder;
use App\Models\Payment;
use App\Models\Shoe;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class OderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oder = DB::table('oders')
            ->join('users','users.id_user','=','oders.id_user')->get();
        return view('oder', compact('oder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $id_us = Auth::user()->id_user;
        $cart = DB::table('carts')->join('shoes', 'carts.id_shoes', '=', 'shoes.id_shoes')
            ->where('carts.id_users', $id_us)->get();
        $user = User::all()->where('id_user', $id_us);
        $delivery = Delivery::all();
        $payment = Payment::all();
        if (is_null($cart->first())) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        } else {
            $subtotal = 0;
            foreach ($cart as $item)
            {
                $total = ($item->quantity * $item->prices_sell);
                $subtotal = ($subtotal + 0) + ($total + 0);
            }
            return view('dathang', compact('cart', 'user', 'delivery', 'payment', 'subtotal', 'total'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id_user=Auth::user()->id_user;
        $user=User::all()->where('id_user',$id_user)->first();
        if (is_null($user->address) or  is_null($user->phone))
        {
            return redirect()->back()->with('error','Bạn cần nhập đủ thông tin!');
        }else{
            $cart = DB::table('carts')->join('shoes','carts.id_shoes','=','shoes.id_shoes')
                ->where('id_users',$id_user)->get();
            $oder= Oder::create([
                'id_user'=>$id_user,
                'sub_total'=>$request->total,
                'created_at'=>new DateTime('now'),
                'status'=>0,
                'condition'=>0
            ]);
            foreach ($cart as $item)
            {
                $details=DetailsOder::create([
                    'id_shoes'=>$item->id_shoes,
                    'id_oder'=>$oder->id_oders,
                    'color'=>$item->color,
                    'size'=>$item->size,
                    'quantity'=>$item->quantity,
                    'id_payment'=>$request->id_payment,
                    'id_delivery'=>$request->id_delivery,
                ]);
                $shoe_detail = DB::table('details_shoes')->where('id_shoes', $item->id_shoes)->first();
                DB::table('details_shoes')->where('id_shoes',$item->id_shoes)->update([
                    'quantity'=>$shoe_detail->quantity - $item->quantity,
                ]);
                Cart::destroy($item->id_carts);
            }
            return view('thongbao')->with('message','Đặt hàng thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $oder=Oder::all()->where('id_oders',$id);
        $oders=DB::table('oders')->join('users','users.id_user','=','oders.id_user')
            ->join('details_oders','oders.id_oders','=','details_oders.id_oder')
            ->join('shoes','shoes.id_shoes','=','details_oders.id_shoes')
            ->join('payment','payment.id_payment','=','details_oders.id_payment')
            ->join('delivery','delivery.id_delivery','=','details_oders.id_delivery')
            ->where('oders.id_oders',$id)->get();
        return view('update-oder',compact('oders','oder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('details_oders')->where('id_oder',$id)->delete();
        Oder::destroy($id);
        return redirect()->back()->with('message','Xóa đơn hàng thành công');
    }
    public function updateconditionoder(Request $request,$id)
    {
        if($request->status)
        {
            DB::table('oders')->where('id_oders',$id)->update([
               'status'=>$request->status
            ]);
            return redirect()->back()->with('message','Cập nhật trạng thái thành công!');
        }
        return redirect()->back();
    }
}
