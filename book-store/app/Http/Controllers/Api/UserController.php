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
    public function store(Request $request, $id = null)
    {   
        $input = $request->except(['_token','_method']);

        if( ! is_null( $id ) ) 
        {
            log::info('create User.........');
            $this->user->createOrUpdate($id, $input);
        }
        else
        {
            log::info('Update User.........');
            $this->user->createOrUpdate($id = null, $input);
        }
        return redirect()->route('user.list');
    }
}
