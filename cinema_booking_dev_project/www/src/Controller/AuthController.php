<?php

namespace App\Controller;

use App\Service\AuthService;
use App\Service\Interfaces\AuthServiceInterface;
use App\Utils\EntityMapperUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/auth")
 */
class AuthController extends AbstractController
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @Route("/signup", name="signup", methods={"POST"})
     */
    public function signup(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $result = $this->authService->register($data);
        return new JsonResponse( EntityMapperUtils::mapUserToArray(  $result,), JsonResponse::HTTP_CREATED);
    }

    /**
     * @Route("/login", name="login", methods={"POST"})
     * @throws \Exception
     */
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $result = $this->authService->login($data);
        return new JsonResponse( EntityMapperUtils::mapUserToArray(  $result,), JsonResponse::HTTP_OK);


    }

}
