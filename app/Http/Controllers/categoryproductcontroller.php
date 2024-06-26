<?php

namespace App\Http\Controllers;
use App\MOdels\cart;
use App\Models\product;
use App\Models\category;

use Illuminate\Http\Request;

class categoryproductcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sominu = product::where('category_id',2)->orderBy('id','DESC')->get();
        $chanvay = product::where('category_id',3)->orderBy('id','DESC')->get();
        $vaydamcongso = product::where('category_id',1)->orderBy('id','DESC')->get();
        $bosuutapmoi = product::orderBy('id','DESC')->take(20)->get();
        $somichanvay = product::where('category_id',5)->orderBy('id','DESC')->get();
        $sandouudai = product::orderBy('gia', 'ASC')->take(20)->get();
        $xahang = product::where('category_id',7)->orderBy('id','DESC')->get();

        $data = [
            'sominu' => $sominu,
            'chanvay' => $chanvay,
            'vaydamcongso' => $vaydamcongso,
            'bosuutapmoi' => $bosuutapmoi,
            'somichanvay' => $somichanvay,
            'sandouudai' => $sandouudai,
            'xahang' => $xahang,
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = category::create(['namecategory' => $request->namecategory]);
        if($productIDs = $request->product_ids){
            // foreach ($productIDs as $productID){ 

            // }
        }
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = category::findOrFail($id);
        return response()->json($category);
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
        $category = category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = category::findOrFail($id);
        $category->delete();
        return response()->json([
            'status'=> 200,
            'message' => "Category deleted successfully!"
        ]);
    }

    public function getAll()
    {
        $categories = Category::with('products')->get();
        return response()->json($categories);
    }
}