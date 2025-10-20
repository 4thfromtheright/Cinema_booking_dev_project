<?php

namespace App\Service;

use App\Entity\CbUsers;

interface UserServiceInterface
{
    public function signup(array $data): CbUsers;
    public function getUserByEmail(string $email): ?CbUsers;
}
