<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $media = $request->all();
        $media['password'] = hash::make($request['password']);
        $user = User::create($media);

        $success['token'] = $user->createToken('MyMedia')->plainTextToken;
        $success['name'] = $user->name;


        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User Register Successfully',
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyMedia')->plainTextToken;
            $success['name'] = $user->name;


            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User Login Successfully',
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'error' => false,
                'message' => 'unauthorized',

            ];
            return response()->json($response);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            "message" => "logged out",

        ];
    }
}
