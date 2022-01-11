<?php

namespace App\Repositories\User;

interface UserInterface 
{
    public function register($input);

    public function login($request);

    public function logout($request);

    public function getAllUsers();

    public function getUserById($id);

    public function update($id = null, $collection = []);

    public function deleteUser($id);
}