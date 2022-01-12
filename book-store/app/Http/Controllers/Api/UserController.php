<?php

namespace App\Http\Controllers\Api;

use Log;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;

class UserController extends Controller
{
    public $user;
    
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    
    public function login(Request $request)
    {
        Log::info('UserController Login....');
        $token = $this->user->login($request);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => "User logged in successfully",
        ]);
    }

    public function register(Request $request)
    {
        Log::info('UserController Register....');
        $input = $request->except(['_token','_method']);
        $token = $this->user->register($input);

        return response()->json([
            'message' => "User registered successfully",
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        Log::info('UserController Logout....');
        $this->user->logout($request);
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function index()
    {
        log::info('getAllUsers.........');
        $users = $this->user->getAllUsers();
        return response()->json([
            "success" => true,
            "message" => "User are fetched.",
            "data" => $users
        ]);
    }

    public function edit($id)
    {
        log::info('getUserById.........');
        $user = $this->user->getUserById($id);
        return response()->json([
            "success" => true,
            "message" => "User is fetched.",
            "data" => $user
        ]);
    }

    public function update(Request $request, $id = null)
    {   
        $input = $request->except(['_token','_method']);

        if(!is_null($id)) 
        {
            log::info('Update User.........');
            $this->user->update($id, $input);
        }
        return redirect()->route('user.list');
    }
}