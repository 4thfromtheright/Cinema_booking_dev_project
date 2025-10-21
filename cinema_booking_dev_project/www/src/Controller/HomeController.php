<?php

namespace App\Controller;

use App\Service\BookingService;
use App\Service\CinemaService;
use App\Service\FilmService;
use App\Service\Interfaces\CinemaServiceInterface;
use App\Service\Interfaces\FilmServiceInterface;
use App\Service\Interfaces\ShowingsServiceInterface;
use App\Service\Interfaces\TheaterServiceInterface;
use App\Utils\EntityMapperUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/home")
 */
class HomeController
{
    private $cinemaService;
    private $filmService;
    private $theaterService;
    private $showingsService;


    public function __construct(CinemaServiceInterface $cinemaService, FilmServiceInterface   $filmService,TheaterServiceInterface  $theaterService,ShowingsServiceInterface $showingsService) {
        $this->cinemaService = $cinemaService;
        $this->filmService = $filmService;
        $this->theaterService = $theaterService;
        $this->showingsService = $showingsService;

    }

    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function getHomePageData()
    {
        $cinemas = $this->cinemaService->getAll();
        $films = $this->filmService->getAll();
        $showings = $this->showingsService->getAll();
        $theaters = $this->theaterService->getAll();
        return new JsonResponse([
            'cinemas' => EntityMapperUtils::mapEntitiesToArrays($cinemas,'cinema'),
            'theaters' => EntityMapperUtils::mapEntitiesToArrays($theaters,'theater'),
            'showings' => EntityMapperUtils::mapEntitiesToArrays($showings,'showing'),
            'films' => EntityMapperUtils::mapEntitiesToArrays($films,'film')
        ]);
    }
}
