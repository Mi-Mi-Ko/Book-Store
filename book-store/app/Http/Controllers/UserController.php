<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
//use App\Services\UserService;
use App\Repository\UserInterface;

class UserController extends Controller
{
    public $user;
    
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        log::info('Index.........');
        $users = $this->user->getAllUsers();
        return response()->json([
            "success" => true,
            "message" => "User are fetched.",
            "data" => $users
        ]);
    }

    public function edit($id)
    {
        log::info('Edit.........');
        $user = $this->user->getUserById($id);
        return response()->json([
            "success" => true,
            "message" => "User is fetched.",
            "data" => $user
        ]);
    }

// protected $userService;
//     public function __construct(UserService $user_service)
//     {
//         $this->userService = $user_service;
//     }

//     public function index(Request $request)
//     {
//         $users = $this->userService->getuser();
//         return response()->json([
//             "success" => true,
//             "message" => "User are fetched.",
//             "data" => $users
//         ]);
//     }
}