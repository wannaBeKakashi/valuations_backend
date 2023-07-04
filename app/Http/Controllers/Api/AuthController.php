<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //
    public function login(LoginRequest $request) : UserResource | JsonResponse
    {
        $authenticated= false;

        //find the user
        $user =User::where('email',$request->email)->first();

        //check if user is found
        if(isset($user)){

            //check if password is valid
            if(Hash::check($request->password,$user->password)){

                //create user access token
                $user->api_token = $user->createToken('access_token')->plainTextToken;
                $user->save();

                //mark as authenticated
                $authenticated  = true;

            }
        }

        if($authenticated){
            return new UserResource($user);
        }
        else
            return response()->json([
                'errors' =>[ 'email'=> ['The provided credentials are incorrect.']],
            ],401);
    }
    public function webLogin(Request $request)
    {

        $validated= $request->validate([
            'email' =>'required|email',
            'password' =>'required|string'
        ]);

        $credentials = $request->only(['email','password']);
        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        }

    }
    public function logout(){


        //to do delete token
    }

}
