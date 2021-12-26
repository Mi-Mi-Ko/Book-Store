<?php

namespace App\Repository;

interface UserInterface 
{
    public function getAllUsers();

    public function getUserById($id);
}