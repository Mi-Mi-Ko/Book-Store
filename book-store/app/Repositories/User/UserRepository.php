<?php

namespace App\Repositories\User;

use Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserInterface;

class UserRepository implements UserInterface
{   
    protected $user = null;

    public function login($request)
    {
        Log::info('UserRepository Login.....');
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }

    public function register($input)
    {
        Log::info('UserRepository Register.....');
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'dob' => $input['dob'],
            'address' => $input['address'],
            'gender' => $input['gender'],
            'phone' => $input['phone'],
            'avatar_url' => $input['avatar_url'],
            'user_type' => $input['user_type'],
            'auth_status' => '1',
            'password' => Hash::make($input['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        
        return $token;
    }

    public function logout($request) {
        Log::info('UserRepository Logout.....');
        auth()->user()->tokens()->delete();
    }

    public function getAllUsers()
    {
        Log::info('UserRepository getAllUsers.....');
        return User::all();
    }

    public function getUserById($id)
    {
        Log::info('UserRepository getUserById.....');
        return User::find($id);
    }

    public function update($id = null, $collection = [])
    {   
        Log::info('UserRepository Update.....');
        if(!is_null($id)) {
            $user = User::find($id);
            $user->name = $collection['name'];
            $user->email = $collection['email'];
            $user->dob = $collection['dob'];
            $user->address = $collection['address'];
            $user->gender = $collection['gender'];
            $user->phone = $collection['phone'];
            $user->avatar_url = $collection['avatar_url'];
            $user->user_type = $collection['user_type'];
            $user->auth_status = '1';
            return $user->save();
        }
    }
    
    public function deleteUser($id)
    {
        Log::info('UserRepository Delete.....');
        return User::find($id)->delete();
    }
}