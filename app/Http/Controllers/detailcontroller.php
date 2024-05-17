<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\detail;

class detailcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = product::with('detail','category')->get();
        return response()->json($detail);
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
        // Kiểm tra xem sản phẩm đã có chi tiết chưa
        $check_detail = detail::where('product_id', $request['product_id'])->first();
        
        if ($check_detail) {
            // Nếu đã có chi tiết rồi thì trả về thông báo
            return response()->json(['error' => 'Chi tiết sản phẩm đã tồn tại']);
        } else {
            // Nếu chưa có thì tiến hành thêm chi tiết mới
            $add_detail = new detail;
            $add_detail->product_id = $request['product_id'];
            $add_detail->tinhtrang = $request['tinhtrang'];
            $add_detail->chatlieu = $request['chatlieu'];
            $add_detail->themanhsp = $request['themanhsp'];
    
            $add_detail->save();
    
            return response()->json($add_detail);
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
       
        $detail = detail::with('product')->where('product_id',$id)->first();
        return response()->json($detail);
       
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
        //
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
    }
    public function detailthongtin(){
        $detailthongtin = detail::all();
        return response()->json($detailthongtin);
    }

    public function deletedetailproduct($id){
        $detail_product = detail::where('id',$id)->first();

        $detail_product->delete();

        return response()->json(['message' => 'xóa success']);
    }
}
