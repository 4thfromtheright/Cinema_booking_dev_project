<?php

namespace App\Service;

interface UserServiceInterface
{
    public function getUserById(int $id);
    public function getAllUsers();
}
