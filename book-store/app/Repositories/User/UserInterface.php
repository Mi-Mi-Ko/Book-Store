<?php

namespace App\Repositories\User;

interface UserInterface 
{
    public function getAllUsers();

    public function getUserById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteUser($id);
}