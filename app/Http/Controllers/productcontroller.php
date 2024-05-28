<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = product::all();

        
        if($title = $request->query('title')){
            return response()->json(product::where('title', 'like', '%'.$title.'%')->get());
        } else {
            return response()->json($product);
        }

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
        $product = product::with('category')->findOrFail($id);
        return response()->json($product);
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
        $product = product::findOrFail($id);
        $product->update($request->except('hinhanh'));
        
        
        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $file_name = Str::random(32).".".$request->hinhanh->getClientOriginalExtension();

            $file->move(public_path('upload'), $file_name);
            $product->hinhanh = $file_name;

            $product->save();
        }

        return response()->json(['product' => $product]);
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