<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin-api')->except('login'); 
    }

    public function login(Request $request)
    {
        if (!Auth::guard('admin')->attempt(['email'=>$request->email , 'password'=>$request->password]))
        {
            return response(['message'=>'Unauthorized' , 'code'=>401]);
        }

        $admin= Admin::where('email' , $request->email)->first();
        $token = $admin->createToken('my-app-token')->plainTextToken;
        $response = ['admin'=>$admin , 'token'=>$token , 'code'=>200];
        return response(['success'=>true , 'data'=>$response]);
    }

    public function getDetails()
    {
        $admin = Auth::guard('admin-api')->user();
        return response()->json(['success'=>true , 'data'=>$admin]);
    }

    public function logout()
    {
        $admin = Auth::user();
        Auth::user()->tokens()->delete();
        return response()->json(['success'=>'Admin Exited' , 'admin'=>$admin]);
    }
}