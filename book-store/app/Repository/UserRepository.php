<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{   
    protected $user = null;

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }
}