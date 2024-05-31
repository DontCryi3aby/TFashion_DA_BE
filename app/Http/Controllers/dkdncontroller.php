<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dkdn;
use Hash;
use Illuminate\Support\Facades\Storage;

class dkdncontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ttkh = dkdn::all();

        return response()->json($ttkh);
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
        $name = $request['hoten'];
        $email = $request['email'];
    
        $existingDkdn = dkdn::where('email',$email)->first();
    
        if ($existingDkdn) {
            return response()->json(['error' => 'Email đã tồn tại'], 400);
        }
    
        $dkdn = new dkdn;
        $dkdn->name = $name;
        $dkdn->sdt = $request['sodt'];
        $dkdn->email = $request['email'];
        $dkdn->password = bcrypt($request->matkhau);
    
        $dkdn->save();
    
        return response()->json($dkdn);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = dkdn::findOrFail($id);
        return response()->json($user);
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
        // return response()->json($request->hasFile('avatar'));

        $user = dkdn::findOrFail($id);
        $user->update($request->except('avatar'));
        
        if($request->hasFile('avatar')){
            $path = $request->file('avatar')->store('avatars', 'public');

            if($oldAvatar = $user->avatar){
                Storage::disk('public')->delete($oldAvatar);
            }

            $user->update(['avatar' => $path]);
        }
        
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = dkdn::find($id);

        $delete->delete();

        return response()->json(['message'=>'xóa thành công']);
    }
}