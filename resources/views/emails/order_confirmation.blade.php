<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>CẢM ƠN BẠN ĐÃ ỦNG HỘ</h1>
    <p>Họ và tên: {{$order->hovaten}}</p>
    <p>Địa chỉ: {{$order->diachi}}, {{$order->phuongxa}}, {{$order->quanhuyen}}, {{$order->tinh}}</p>
    <p>Số điện thoại: 0{{$order->sdt}}</p>
    <p>Lời nhắn: {{$order->thongtinbosung}}</p>
    <p>Ngày đặt: {{$order->created_at}}</p>
    <p>Phương thức thanh toán: {{$order->pttt}}</p>
    <p>Sản phẩm đặt: {{$order->sanpham}}</p>
    <p>Tổng tiền: {{$order->thanhtien}}</p>
</body>
</html>
