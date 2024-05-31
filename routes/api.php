<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\categoryproductcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\productcontroller;
use App\Models\category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/index','App\Http\Controllers\homecontroller@index');

Route::get('/homeadmin','App\Http\Controllers\userscontroller@index');
Route::post('/user','App\Http\Controllers\userscontroller@store');

Route::get('/detail/{id}','App\Http\Controllers\detailcontroller@show');
Route::get('/detaildanhmuc','App\Http\Controllers\detailcontroller@index');
Route::get('/detailthongtin','App\Http\Controllers\detailcontroller@detailthongtin');
Route::post('/add_detail','App\Http\Controllers\detailcontroller@store');
Route::delete('detail_product/{id}', 'App\Http\Controllers\detailcontroller@deletedetailproduct');

Route::get('/product','App\Http\Controllers\productcontroller@index');
Route::get('/product/{id}','App\Http\Controllers\productcontroller@show');
Route::post('/add_product','App\Http\Controllers\productcontroller@store');
Route::delete('/deleteproduct/{id}','App\Http\Controllers\productcontroller@destroy');
Route::get('/thuocdanhmuc','App\Http\Controllers\productcontroller@thuocdanhmuc');
Route::patch('/products/{id}',[productcontroller::class, 'update']);

Route::get('/check/{id}', 'App\Http\Controllers\checkoutcontroller@show');
Route::post('/checkclient', 'App\Http\Controllers\checkoutcontroller@store');

Route::get('/users/{userid}/homecart', 'App\Http\Controllers\cartcontroller@index');
Route::get('/users/{userid}/slsptgh', 'App\Http\Controllers\cartcontroller@slsptgh');
Route::delete('/deletecart/{id}','App\Http\Controllers\cartcontroller@destroy');
Route::post('/cart/{id}','App\Http\Controllers\cartcontroller@store');


Route::get('/thongtinkhachhang','App\Http\Controllers\dkdncontroller@index');
Route::post('/dkdn','App\Http\Controllers\dkdncontroller@store');
Route::delete('/thongtinkhachhang/{id}','App\Http\Controllers\dkdncontroller@destroy');
Route::patch('/users/{id}','App\Http\Controllers\dkdncontroller@update');
Route::get('/users/{id}','App\Http\Controllers\dkdncontroller@show');


Route::get('/dondathang','App\Http\Controllers\dondathangcontroller@index');
Route::post('/dondathang','App\Http\Controllers\dondathangcontroller@store');
Route::put('/update-tinhtrangdon/{id}','App\Http\Controllers\dondathangcontroller@update');
Route::delete('admindeletedondathang/{id}', 'App\Http\Controllers\dondathangcontroller@deletedondathang');

Route::post('/login', [homecontroller::class, 'login']);
Route::post('/accountlogin', [homecontroller::class, 'accountlogin']);


Route::get('/categoryproduct','App\Http\Controllers\categoryproductcontroller@index');
Route::get('/categories','App\Http\Controllers\categoryproductcontroller@getAll');
Route::post('/categories', [categoryproductcontroller::class, 'store']);
Route::patch('/categories/{id}', [categoryproductcontroller::class, 'update']);
Route::delete('/categories/{id}', [categoryproductcontroller::class, 'destroy']);

Route::post('/checkout/{id}','App\Http\Controllers\checkoutcontroller@index');


Route::get('/homedashboard','App\Http\Controllers\dashboardcontroller@index');


//gửi mail
Route::post('/send-mail/{id}', 'App\Http\Controllers\SendMailController@sendMail');
Route::delete('giohang/{userId}/delete-all', 'App\Http\Controllers\cartcontroller@deleteAllItems');