<?php

namespace App\Http\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Models\dondathang;
use App\Models\dkdn;


class SendMailController extends Controller
{
    public function sendMail(Request $request,$id) {
      // Validate the request data
  
     
      $email = dkdn::where('id', $id)->first();
      // Store the order in the database
      $order = dondathang::with('dkdn')->where('dkdn_id', $id)->orderBy('id','DESC')->first();
      $hovaten = $order->hovaten;
      $diachi = $order->diachi;
      $tinh = $order->tinh;
      $quanhuyen = $order->quanhuyen;
      $phuongxa = $order->phuongxa;
      $sdt = $order->sdt;
      $thongtinbosung = $order->thongtinbosung;
      $created_at = $order->created_at;
      $pttt = $order->pttt;
      $sanpham = $order->sanpham;
      $thanhtien = $order->thanhtien;
      
      // Convert the `$sanpham` array to a string for display in the email
     
      
      // Gửi email xác nhận đơn hàng
      Mail::to($email->email)->send(new OrderConfirmation($order));
    
      

    return response()->json(['message' => 'Order placed successfully']);
}
    }
    

