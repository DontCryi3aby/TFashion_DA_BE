<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;

class productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product::all();
        return response()->json($product);
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
        $product = new Product;
        $product->title = $request['title'];
        $product->gia = $request['gia'];
        $product->category_id = $request['category_id'];
    
        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $file_name = $file->getClientOriginalName();
          
    
            // Di chuyển file ảnh vào thư mục public/upload
            $file->move(public_path('upload'), $file_name);
    
            // Lưu đường dẫn ảnh vào database
            $product->hinhanh = $file_name;
        } else {
            $product->hinhanh = '';
        }
    
        $product->save();
    
        return response()->json(['message' => 'Product created successfully!', 'data' => $product]);
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
        $deleteproduct = product::find($id);
        $deleteproduct->delete();

        return response()->json(['message' => 'Product created successfully!']);
    }
    public function thuocdanhmuc(){
        $category = category::all();
     

        
        return response()->json($category);
    }

    
}
