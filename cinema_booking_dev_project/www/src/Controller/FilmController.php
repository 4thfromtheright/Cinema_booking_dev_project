<?php

namespace App\Controller;

use App\Service\FilmService;
use App\Service\Interfaces\FilmServiceInterface;
use App\Utils\EntityMapperUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/films")
 */
class FilmController extends AbstractController
{
    private $filmService;

    public function __construct(FilmServiceInterface $filmService)
    {
        $this->filmService = $filmService;
    }

    /**
     * @Route("/", name="get_films", methods={"GET"})
     */
    public function getFilms(): JsonResponse
    {
        $films = $this->filmService->getAll();
        return new JsonResponse( EntityMapperUtils::mapEntitiesToArrays($films,'films'));
    }

    /**
     * @Route("/{id}", name="get_film", methods={"GET"})
     * @throws \Exception
     */
    public function getFilm($id): JsonResponse
    {
        $film = $this->filmService->getFilmById($id);
        return new JsonResponse(EntityMapperUtils::mapFilmToArray($film));
    }


}
