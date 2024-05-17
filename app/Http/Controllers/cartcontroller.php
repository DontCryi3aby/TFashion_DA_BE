<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\detail;
use App\Models\product;
use App\Models\dkdn;

class cartcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userid)
    { 
        $product = product::all();
       
        $cart = cart::with('product', 'dkdn')
            ->where('dkdn_id', $userid) // Update variable name here
            ->orderBy('id', 'DESC')
            ->get();
        
        return response()->json($cart);
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
    public function store(Request $request,$id)
    {
        $title = $request['title'];
        $size = $request['size'];
        $gia = $request['gia'];
        $soluong = $request['soluong'];
        $tong = $request['tong'];
        $product_id = $request['product_id'];
        $dkdn_id = $request['dkdn_id'];
    
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $existingProduct = cart::where('title', $title)
            ->where('size', $size)
            ->where('gia', $gia)
            ->where('dkdn_id',$id)
            ->first();
    
        if ($existingProduct) {
            // Sản phẩm đã có trong giỏ hàng
            return response()->json(['message' => 'Sản phẩm đã có trong giỏ hàng']);
        }
    
        // Thêm sản phẩm vào giỏ hàng
        $cart = new cart;
        $cart->title = $title;
        $cart->size = $size;
        $cart->gia = $gia;
        $cart->soluong = $soluong;
        $cart->tong = $tong;
        $cart->product_id = $product_id;
        $cart->dkdn_id = $dkdn_id;
        $cart->save();
    
        // Trả về thông tin sản phẩm vừa được thêm vào
        return response()->json($cart);
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
        $delete = cart::find($id);
        $delete->delete();

        return response()->json(['message' => 'đã xóa sản phầm khỏi giỏ hàng']);
    }
   public function slsptgh($userid){
    $slsptcart= cart::where('dkdn_id',$userid)->count();
  

  

    return response()->json($slsptcart);
   }

   public function deleteAllItems($userId)
   {
       // Xóa tất cả các sản phẩm trong giỏ hàng của người dùng
       cart::where('dkdn_id', $userId)->delete();

       return response()->json(['message' => 'Đã xóa tất cả các sản phẩm trong giỏ hàng']);
   }
}
