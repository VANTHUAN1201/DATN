<?php

namespace App\Http\Controllers;

use App\Models\Batdongsan;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Shoe::where('shoes_name', 'LIKE', '%' . $request->country . '%')->take(6)->get();
            $output = '';
            if (count($data) > 0) {

                $output = '<ul class="list-group" >';
                foreach ($data as $row) {

                    $output .= '<li class="list-group-item-action"><a href="' . route('chitiet', $row->id_shoes) . '">' . $row->shoes_name . '<a/></li><br>';
                }
                $output .= '</ul>';
            } else {

                $output .= '<li class="list-group-item">' . 'Không tìm thấy sản phẩm' . '</li>';
            }
            return $output;
        }
    }
}
