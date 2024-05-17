<?php

namespace App\Http\Controllers;
use App\Models\cart;
use App\Models\dondathang;
use App\Models\checkout;
use Illuminate\Http\Request;

class checkoutcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {   
        $vnpay = checkout::create(
            ["sanpham" => $request->sanpham,
            "sotien" => $request->tongtienclient,
            "nganhang" => $request->nganhangclient,
            "madonhang" => $request->madonhangclient,
            "dkdn_id" => $id]);
        
        $madonhang = $vnpay->madonhang;
        $tensp = $vnpay->sanpham;
        $sotien = $vnpay->sotien;
        $nganhang = $vnpay->nganhang;
    
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:3000/checkout";
        $vnp_TmnCode = "4IMEN6TS"; // Mã website tại VNPAY 
        $vnp_HashSecret = "QTSIZQ1MNQ2RFVWJTWHHUXZAMKOUNS98"; // Chuỗi bí mật
    
        $vnp_TxnRef = $madonhang;
        $vnp_OrderInfo = 'Thanh toán hóa đơn';
        $vnp_OrderType = 'TFashion';
        $vnp_Amount = $sotien * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = $nganhang;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
    
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
    
        ksort($inputData);
        $query = http_build_query($inputData);
        $hashdata = hash_hmac('sha512', $query, $vnp_HashSecret);
    
        $vnp_Url .= "?" . $query . '&vnp_SecureHash=' . $hashdata;
    
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode([
                'code' => '00',
                'message' => 'success', // Set the appropriate value based on the condition
                'data' => $vnp_Url
            ]);
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
        $vnpay = new checkout;
        $vnpay->sanpham = $request['tenspclient'];
        $vnpay->sotien = $request['tongtienclient'];
     
        $vnpay->nganhang = $request['nganhangclient'];
        $vnpay->madonhang = $request['madonhangclient'];
        $vnpay->dkdn_id = $request['dkdn_id'];

        $vnpay->save();

        return response()->json($vnpay);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thongtin = cart::where('dkdn_id',$id)->get();

        return response()->json($thongtin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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

}