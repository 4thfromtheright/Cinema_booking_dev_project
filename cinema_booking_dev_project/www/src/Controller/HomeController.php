<?php

namespace App\Controller;

use App\Service\BookingService;
use App\Service\CinemaService;
use App\Service\FilmService;
use App\Utils\EntityMapperUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    private $cinemaService;
    private $filmService;


    public function __construct(CinemaService $cinemaService, FilmService   $filmService) {
        $this->cinemaService = $cinemaService;
        $this->filmService = $filmService;

    }

    /**
     * @Route("/api/home", name="home", methods={"GET"})
     */
    public function index()
    {
        $cinemas = $this->cinemaService->getAll();
        $films = $this->filmService->getAll();
        return new JsonResponse([
            'cinemas' => EntityMapperUtils::mapEntitiesToArrays($cinemas,'cinema'),
            'films' => EntityMapperUtils::mapEntitiesToArrays($films,'cinema')
        ]);
    }
}
