<?php

namespace App\Service;

use App\Repository\CbUsersRepository;

class UserService implements UserServiceInterface
{
    private $userRepo;

    public function __construct(CbUsersRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getUserById(int $id)
    {
        return $this->userRepo->find($id);
    }

    public function getAllUsers()
    {
        return $this->userRepo->findAll();
    }
}
