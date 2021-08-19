<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;  //This is the user model / Models / Use


class UserController extends Controller
{
    /**
     * User CRUD section
     */
    public function user_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|between:8,50|confirmed'
        ]);

        //Check if the data entered is valid
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        //To hash the passorwd
        $request['password'] = Hash::make($request['password']);

        $user = new User();
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();
        $response = 'Successfully created user';
        return response($response, 200);
    }

    public function user_update(Request $request, $id)
    {
        $user = User::find($request->id);

        $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:50',
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|between:8,50|confirmed'
        ]);

        //Check if the data entered is valid
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
    
        $request['password']=Hash::make($request['password']);

        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->update();
        return $user;
    }

    public function user_delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        $response = 'Deleted Successed!';
        return response($response, 422);
    }

    public function user_index()
    {
        //get all user list
        return User::all();
    }

    /**
     * Login secction
     */

     // Log in user
    public function login(Request $request)
    {
        /**
         * php artisan passport:install
         * php artisan vendor:publish --tag=passport-config
         * Este segundo es muy necesario, ya que si no se hace la publicación, no retorna el token
         */
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = request(['email', 'password']);

        //Check if the user has the credentials
        if (!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }

    //Logout user
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been succesfully logged out!';
        return response($response, 200);
    }
}
