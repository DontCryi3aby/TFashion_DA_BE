<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\dkdn;
use App\Models\accountlogin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
class homecontroller extends Controller

{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaydamcs = product::where('category_id',1)->orderBy('id','DESC')->get();
        $sominu = product::where('category_id',2)->orderBy('id','DESC')->get();
        $chanvay = product::where('category_id',3)->orderBy('id','DESC')->get();
 
        $data = [
           
                'vaydamcs' => $vaydamcs,
                'sominu' => $sominu,
                'chanvay' => $chanvay,
            ];
        
        
        return response()->json($data, 201);
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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function login(Request $request)
    {
        if($request->is_google_login || $request->is_facebook_login){
            $user = dkdn::where('email', $request->email)->first();
            if($user){
                $accessToken = $user->createToken('login')->accessToken;
                return response()->json(['access_token' => $accessToken, 'user' => $user], 200);
            }
            else {
                $newUser = dkdn::create([
                    'name'=>$request->name,
                    'sdt'=> 969696969,
                    'email'=>$request->email,
                    'password'=>bcrypt('243243'),
                ]);

                if($request->hasFile('avatar')){
                    $path = $request->file('avatar')->store('avatars', 'public');
                    $newUser->update(['avatar' => $path]);
                }

                $accessToken = $newUser->createToken('login')->accessToken;

                return response()->json(['access_token' => $accessToken, 'user' => $newUser], 200);
            }
        }
        else {
            // Lấy email và password từ request
            $email = $request->input('email');
            $password = $request->input('password');
           
            // Tìm người dùng bằng email
            $user = dkdn::where('email', $email)->first();
    
            // Kiểm tra xem người dùng có tồn tại và mật khẩu có chính xác hay không
            if ($user && Hash::check($password, $user->password)) {
                // Tạo một access token mới
                $accessToken = $user->createToken('login')->accessToken;
    
                // Trả về access token như một phản hồi
                return response()->json(['access_token' => $accessToken, 'user' => $user], 200);
            } else {
                // Trả về một phản hồi lỗi nếu người dùng không tồn tại hoặc mật khẩu không chính xác
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

        }
    }

    public function accountlogin(Request $request)
    {
        // Lấy email và password từ request
        $email = $request->input('email');
        $password = $request->input('password');
    
        // Tìm người dùng bằng email
        $user = accountlogin::where('email', $email)->first();
        
    
        // Kiểm tra xem người dùng có tồn tại và mật khẩu có chính xác hay không
        if ($user && Hash::check($password,$user->password)) {
            // Tạo một access token mới
            $accessToken = $user->createToken('login')->accessToken;
    
            // Trả về access token như một phản hồi
            return response()->json(['access_token' => $accessToken, 'user' => $user], 200);
        } else {
            // Trả về một phản hồi lỗi nếu người dùng không tồn tại hoặc mật khẩu không chính xác
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
    
    }

  