<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Bridge\Client;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:55|unique:users',
            'password' => 'required|between:8,255|',


        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);

        }

        $passwordGrandClient = \Laravel\Passport\Client::where('password_client', 1)->fisrt();

        $data = [
            'grant_type' => 'password',
            'client_id' => $passwordGrandClient->id,
            'client_secret' => $passwordGrandClient->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*'

        ];

        $tokenRequest = Request::create('/oauth/token','post',$data);

     return app() -> handle($tokenRequest);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:55|unique:users',
            'password' => 'required|between:8,255|confirmed',


        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);

        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'registration failed'], 500);
        }
        return response()->json(['success' => true, 'message' => 'registration succeeded'], 500);
    }

}
