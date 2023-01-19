<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt(['email'=>$request->email , 'password'=>$request->password]))
        {
            return response(['message'=>'Unauthorized' , 'code'=>401]);
        }

        $user= User::where('email' , $request->email)->first();
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = ['user'=>$user , 'token'=>$token , 'code'=>200];
        return response(['success'=>true , 'data'=>$response]);
    }
}