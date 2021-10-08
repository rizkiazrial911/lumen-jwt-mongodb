<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){
        try{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]);
            $data = array(
                "name" => $request->post('name'),
                "email" => $request->post('email'),
                "password" => Hash::make($request->post('password')),
            );
            // dd($data);
            $register = User::create($data);
            if($register){
                return response()->json([
                    "message" => "Success register user",
                    "data" => $register,
                ], 201);
            }else{
                return response()->json([
                    "message" => "Failed register user"
                ], 400);
            }
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function login(Request $request){
        try{
            $email = $request->post('email');
            $password = $request->post('password');
            $credentials = $request->only(['email', 'password']);
            $token = auth('api')->setTTL(60)->attempt($credentials, true);
            if($token){
                $jwt = $this->respondWithToken($token);
                $user = User::where([
                                        ['email' => $email]
                                    ])
                            ->first();
                $user->update([
                    "api_token" => $jwt->original['token'],
                ]);
                return response()->json([
                    "message" => 'Success Login',
                    "data" => [
                        "user" => $user,
                        "api_token" => $jwt->original
                    ]
                ], 201);
            }else{
                return response()->json([
                    "message" => 'Email or Password not found'
                ], 403);
            }
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function refresh_token(Request $request){
        try{
            $user = User::where([
                                        ['api_token' => $request->bearerToken()]
                                ])
                        ->first();
            $new_token = auth()->refresh();
            $user->update([
                "api_token" => $new_token 
            ]);
            return response()->json([
                    "message" => "Success refresh token",
                    "data" => [
                        "new_token" => $new_token
                    ]
                ], 201);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function check_login(){
        try{
            return response()->json([
                    "message" => "Your has authorized",
                ], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function logout(Request $request){
        try{
            $user = User::where([
                                    ['api_token' => $request->bearerToken()]
                                ])
                        ->update([
                                    "api_token" => '' 
                                ]);
            auth()->logout(true);
            return response()->json([
                    "message" => "success logout",
                ], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
