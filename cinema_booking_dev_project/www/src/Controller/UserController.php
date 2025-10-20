<?php

namespace App\Controller;

use App\Service\UserServiceInterface;
use App\Utils\EntityMapperUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/api/users/{id}", name="get_user", methods={"GET"})
     */
    public function show($id)
    {

        return new JsonResponse( EntityMapperUtils::mapEntitiesToArrays($this->userService->getUserById((int)$id),'user'));
    }
}
