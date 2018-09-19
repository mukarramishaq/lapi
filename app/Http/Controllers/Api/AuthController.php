<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class AuthController extends Controller
{
    //
    /**
     * this function performs log in functionality
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);
        //if validation fails
        if ($validator->fails()) {
            return response()->json(["error"=>$validator->errors()], 400);
        }
        //otherwise
        $credentials = $request->only(["email", "password"]);
        //attempt login
        if (!Auth::attempt($credentials)) {
            //when login attempt fails
            return response()->json(["error"=>__('api.auth.failed.login')], 401);
        }
        //when login attempt succeeds
        $success['token'] = Auth::user()->createToken('Personal Access Token')->accessToken;
        $success['token_type'] = 'Bearer';
        //return response
        return response()->json(["success"=>$success], 200);
    }

    /**
     * this function performs registering functionality.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        //validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);
        //if validation fails
        if ($validator->fails()) {
            return response()->json(["error"=>$validator->errors()], 400);
        }
        //otherwise
        $data = $request->only("name", "email", "password");
        //encrypt the password
        $data['password'] = bcrypt($data['password']);
        //create the user
        $user = User::create($data);
        //create access token
        $success['token'] = $user->createToken('Personal Access Token')->accessToken;
        $success['token_type'] = 'Bearer';
        //return the response
        return response()->json(["success"=>$success], 200);
    }

    /**
     * logout the requesting user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        //revoke access token
        $request->user()->token()->revoke();
        return response()->json(["success"=>__('api.auth.success.logout')], 200);
    }
}
