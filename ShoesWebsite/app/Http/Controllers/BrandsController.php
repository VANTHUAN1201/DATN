<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Shoe;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brand=Brand::all();
        return view('brand',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create-brand');
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
        $check=Brand::all()->where('brandname',$request->brand_name)->first();
        if (is_null($check))
        {
            Brand::create([
                'brandname'=>$request->brand_name
            ]);
            return redirect()->back()->with('message','Thêm mới thành công');
        }else{
            return redirect()->back()->with('error','Thương hiệu đã tồn tại');
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
        //@brand= Brand::where
        $brand=Brand::all()->where('id_brand',$id)->first();
        return view('sanpham',['category'=>$category]);
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
        return view('',compact(''));
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
        $check=Brand::all()->where('brandname',$request->brand_name)->first();
        if (is_null($check))
        {
            DB::table('brands')->where('id_brand',$id)->update([
               'brandname'=>$request->brand_name
            ]);

            return redirect()->back()->with('message','chỉnh sửa thành công!');
        } else{
            return redirect()->back()->with('error','đã tồn tại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check=DB::table('shoes')->join('brands','shoes.id_brand','=','brands.id_brand')
            ->where('brands.id_brand',$id)->first();
        if(is_null($check))
        {
            Brand::destroy($id);
            return redirect()->back()->with('message','Xóa thành công!');
        }else{
            return redirect()->back()->with('error','Không thể xóa!');
        }
    }
}
