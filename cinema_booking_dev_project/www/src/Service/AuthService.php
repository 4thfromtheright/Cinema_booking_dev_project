<?php

namespace App\Service;

use App\Factory\CbUsersFactory;
use App\Repository\CbUsersRepository;
use App\Service\Interfaces\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    private $userRepo;
    private $userFactory;

    public function __construct(CbUsersRepository $userRepo, CbUsersFactory $userFactory)
    {
        $this->userRepo = $userRepo;
        $this->userFactory = $userFactory;
    }

    public function register(array $data)
    {
        // Check required fields
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            throw new \Exception('Name, email and password are required.');
        }

        // Check if email already exists
        $existing = $this->userRepo->findOneBy(['email' => $data['email']]);
        if ($existing) {
            throw new \Exception('Email already exists');
        }

        // Hash the password
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        // Create the user entity via the factory
        return $this->userFactory->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password_hash' => $hashedPassword,
        ]);
    }


    public function login(array $data)
    {
        $user = $this->userRepo->findOneBy(['email' => $data['email']]);
        if (!$user) {
            throw new \Exception('Invalid email or password');
        }

        if (!password_verify($data['password'], $user->getPassword())) {
            throw new \Exception('Invalid email or password');
        }

        return $user;
    }


}
