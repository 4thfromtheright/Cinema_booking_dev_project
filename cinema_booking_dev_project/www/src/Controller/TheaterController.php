<?php

namespace App\Controller;

use App\Service\Interfaces\FilmServiceInterface;
use App\Service\Interfaces\TheaterServiceInterface;
use App\Utils\EntityMapperUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/theaters")
 */
class TheaterController extends AbstractController
{
    private $theaterService;
    private $filmService;

    public function __construct(TheaterServiceInterface $theaterService,FilmServiceInterface $filmService)
    {
        $this->theaterService = $theaterService;
        $this->filmService = $filmService;
    }

    /**
     * @Route("/{id}/theaters", name="get_theaters_by_cinema", methods={"GET"})
     */
    public function getTheatersByCinema(int $id): JsonResponse
    {

            $theaters = $this->theaterService->getTheatersByCinema($id);
            return new JsonResponse(EntityMapperUtils::mapEntitiesToArrays($theaters,'theater'));


    }

    /**
     * @Route("/{id}/films", name="get_films_by_theater", methods={"GET"})
     */
    public function getFilmsByTheater(int $id): JsonResponse
    {

            $films = $this->filmService->getFilmsByTheater($id);

            if(!$films){
                return new JsonResponse(["COULD NOT FIND FILMS"]);
            }

            return new JsonResponse(

                EntityMapperUtils::mapEntitiesToArrays( $films,'film'));

    }

}