<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\DetailsColorShoe;
use App\Models\DetailsImagesShoe;
use App\Models\DetailsShoe;
use App\Models\DetailsSizeShoe;
use App\Models\Image;
use App\Models\Shoe;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $shoe = DB::table('shoes')->join('categories','shoes.id_category','=','categories.id_category')
           ->join('brands','brands.id_brand','=','shoes.id_brand')->get();
       return view('shoe',compact('shoe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brand=Brand::all();
        $category=Category::all();
        $size=Size::all();
        $color=Color::all();
        return view('create-shoes', compact('brand','size', 'color', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check=Shoe::all()->where('shoes_name',$request->shoesname)->first();
        if(is_null($check))
        {
            if($image=$request->file('file'))
            {
                $destinationPath = 'images/';
                $profileImage = $image->getClientOriginalName();
                $image->move($destinationPath, $profileImage);
                $data = "http://127.0.0.1:8000/images/$profileImage";
            }
            $shoes=Shoe::create([
                'shoes_name'=>$request->shoesname,
                'id_category'=>$request->id_category,
                'id_brand'=>$request->id_brand,
                'prices_buy'=>$request->prices_buy,
                'prices_sell'=>$request->prices_sell,
                'images'=>$data,
            ]);
            $chitiet= DetailsShoe::create([
                'id_shoes'=>$shoes->id_shoes,
                'quantity'=>$request->quantity,
                'title'=>$request->title,
                'context'=>$request->context
            ]);
            if($request->file('files'))
            {
                foreach ($request->file('files') as $files=>$value) {
                    $destinationPath = 'images/';
                    $profileImage = $value->getClientOriginalName();
                    $value->move($destinationPath, $profileImage);
                    $data= "http://127.0.0.1:8000/images/$profileImage";
                    $check=DB::table('images')->where('images',$data)->first();
                    $img = Image::create([
                        'images' => $data
                    ]);
                    DetailsImagesShoe::create([
                        'id_details_shoes' => $chitiet->id_details_shoes,
                        'id_images' => $img->id_images,
                    ]);
                }
            }
            if($request->colors)
            {
                foreach ($request->colors as $color=>$value)
                {
                    DetailsColorShoe::create([
                        'id_details_shoes'=>$chitiet->id_details_shoes,
                        'id_color'=>$value,
                    ]);
                }
            }
            if($request->sizes)
            {
                foreach ($request->sizes as $size=>$value)
                {

                    DetailsSizeShoe::create([
                        'id_details_shoes'=> $chitiet->id_details_shoes,
                        'id_size'=>$value,
                    ]);
                }
            }
            return redirect()->back()->with('message','Thêm mới thành công!');
        }else{
            return redirect()->back()->with('error','Sản phẩm đã tồn tại');
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
        $chitiet=DB::table('shoes')->join('brands','shoes.id_brand','=','brands.id_brand')
            ->join('categories','categories.id_category','=','shoes.id_category')
            ->join('details_shoes','details_shoes.id_shoes','=','shoes.id_shoes')->where('shoes.id_shoes',$id)->get();
        $id_details=DB::table('details_shoes')->where('id_shoes',$id)->get()->value('id_details_shoes');
        $images=DetailsImagesShoe::with('image')->where('id_details_shoes',$id_details)->get();
        $size=DetailsSizeShoe::with('size')->where( 'id_details_shoes',$id_details)->get();
        $color=DetailsColorShoe::with('color')->where('id_details_shoes',$id_details)->get();
        return view('chitiet-sanpham',compact('chitiet','images','size','color'));
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
        $chitiet=DB::table('shoes')->join('brands','shoes.id_brand','=','brands.id_brand')
            ->join('categories','categories.id_category','=','shoes.id_category')
            ->join('details_shoes','details_shoes.id_shoes','=','shoes.id_shoes')->where('shoes.id_shoes',$id)->get();
        $category=Category::all();
        $brand=Brand::all();
        $id_details=DB::table('details_shoes')->where('id_shoes',$id)->get()->value('id_details_shoes');
        $images=DetailsImagesShoe::with('image')->where('id_details_shoes',$id_details)->get();
        $size=Size::all();
        $color=Color::all();
        $shoesize=DetailsSizeShoe::with('size')->where('id_details_shoes',$id_details)->get();
        $shoecolor=DetailsColorShoe::with('color')->where('id_details_shoes',$id_details)->get();
        return view('update-shoes',compact('chitiet','images','size','color','brand','category','shoecolor','shoesize'));
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
        $check=Shoe::all()->where('shoes_name',$request->shoesname)->where('id_shoes','!=',$id)->first();
        $id_details=DB::table('details_shoes')->where('id_shoes',$id)->get()->value('id_details_shoes');
        $images=DetailsImagesShoe::with('image')->where('id_details_shoes',$id_details)->get();
        $data=Shoe::all()->where('id_shoes',$id);
        if(is_null($check))
        {
            foreach ($data as $key)
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
            $shoes=DB::table('shoes')->where('id_shoes',$id)->update([
                'shoes_name'=>$request->shoesname,
                'id_category'=>$request->id_category,
                'id_brand'=>$request->id_brand,
                'prices_buy'=>$request->prices_buy,
                'prices_sell'=>$request->prices_sell,
                'images'=>$data,
            ]);
            $chitiet=DB::table('details_shoes')->where('id_shoes',$id)->update([
                'quantity'=>$request->quantity,
                'title'=>$request->title,
                'context'=>$request->context
            ]);
            if($request->file('files'))
            {
                DB::table('details_images_shoes')->where('id_details_shoes',$id_details)->delete();
                foreach ($request->file('files') as $files=>$value) {
                    $destinationPath = 'images/';
                    $profileImage = $value->getClientOriginalName();
                    $value->move($destinationPath, $profileImage);
                    $data= "http://127.0.0.1:8000/images/$profileImage";
                    $img = Image::create([
                        'images' => $data
                    ]);
                    DetailsImagesShoe::create([
                        'id_details_shoes'=>$id_details,
                        'id_images' => $img->id_images
                    ]);
//                    DB::table('details_images_shoes')->where('id_details_shoes',$id_details)->update([
//                        'id_images' => $img->id_images,
//                    ]);
                }
            }
            if($request->colors)
            {
                DB::table('details_color_shoes')->where('id_details_shoes',$id_details)->delete();
                foreach ($request->colors as $color=>$value)
                {
                    DetailsColorShoe::create([
                        'id_color'=>$value,
                        'id_details_shoes'=>$id_details
                    ]);
                }
            }
            if($request->sizes)
            {
                DB::table('details_size_shoes')->where('id_details_shoes',$id_details)->delete();
                foreach ($request->sizes as $size=>$value)
                {
                    DetailsSizeShoe::create([
                        'id_details_shoes'=>$id_details,
                        'id_size'=>$value
                    ]);
                }
            }
            return redirect()->back()->with('message','Chỉnh sửa thành công!');
        }else{
            return redirect()->back()->with('error','Sản phẩm đã tồn tại!');
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
        //
        $check=DB::table('details_oders')->join('shoes','details_oders.id_shoes','=','shoes.id_shoes')
            ->where('shoes.id_shoes',$id)->first();
        $check2=DB::table('cart')->where('id_shoes',$id)->first();
        if(is_null($check))
        {
            if(is_null($check2))
            {
                $id_details=DB::table('details_shoes')->where('id_shoes',$id)->get()->value('id_details_shoes');
                DB::table('details_images_shoes')->where('id_details_shoes',$id_details)->delete();
                DB::table('details_color_shoes')->where('id_details_shoes',$id_details)->delete();
                DB::table('details_size_shoes')->where('id_details_shoes',$id_details)->delete();
                DB::table('details_shoes')->where('id_details_shoes',$id_details)->delete();
                DB::table('shoes')->where('id_shoes',$id)->delete();
                return redirect()->back()->with('message','Shoe Deleted');

            }else{
                DB::table('carts')->where('id_shoes','=',$id)->delete();
                $id_details=DB::table('details_shoes')->where('id_shoes',$id)->get()->value('id_details_shoes');
                DB::table('details_images_shoes')->where('id_details_shoes',$id_details)->delete();
                DB::table('details_color_shoes')->where('id_details_shoes',$id_details)->delete();
                DB::table('details_size_shoes')->where('id_details_shoes',$id_details)->delete();
                DB::table('details_shoes')->where('id_details_shoes',$id_details)->delete();
                DB::table('shoes')->where('id_shoes',$id)->delete();
                return redirect()->back()->with('message','Shoe Deleted');
            }
        }else{
            return redirect()->back()->with('error','Cant delete shoe.');
        }

    }
}
