<?php

namespace App\Service\Interfaces;

use App\Entity\CbUsers;

interface AuthServiceInterface
{


    public function login(array $data);

    public function register(array $data);
}
