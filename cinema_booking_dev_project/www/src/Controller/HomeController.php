<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Service\HomeServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    private $homeService;
    private $security;

    public function __construct(HomeServiceInterface $homeService, Security $security)
    {
        $this->homeService = $homeService;
        $this->security = $security;
    }

    /**
     * @Route("/api/home", name="home", methods={"GET"})
     */
    public function home(): JsonResponse
    {
        $user = $this->security->getUser();

        return $this->json([
            'user' => $user ? $user->getEmail() : null,
            'cinemas' => $this->homeService->listCinemas(),
        ]);
    }
}
