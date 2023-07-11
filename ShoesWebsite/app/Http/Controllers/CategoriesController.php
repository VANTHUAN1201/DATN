<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();
        return view('category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create-categores');
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
        $check = Category::all()->where('category_name', $request->category_name)->first();
        if (is_null($check)) {
            Category::create([
                'category_name' => $request->category_name
            ]);
            return redirect()->back()->with('message', 'Thêm mới thành công!');
        } else {
            return redirect()->back()->with('error', 'Danh mục đã tồn tại');
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
        $category = Category::all()->where('id_category', $id);
        return view('update-category', compact('category'));
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
        $check = Category::all()->where('category_name', $request->category_name)
            ->where('id_category','!=',$id)->first();
        if (is_null($check)) {
            DB::table('categories')->where('id_category', $id)->update([
                'category_name' => $request->category_name
            ]);
            return redirect()->back()->with('message', 'Chỉnh sửa thành công');
        } else {
            return redirect()->back()->with('error', 'Đã tồn tại!');
        }
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
        $check = DB::table('categories')->join('shoes', 'categories.id_category', '=', 'shoes.id_category')
            ->where('categories.id_category', $id)->first();
        if (is_null($check)) {
            Category::destroy($id);
            return redirect()->back()->with('message', 'Xóa thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại!');
        }

    }
}
