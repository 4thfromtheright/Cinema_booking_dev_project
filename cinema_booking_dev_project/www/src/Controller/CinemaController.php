<?php

namespace App\Controller;

use App\Service\Interfaces\CinemaServiceInterface;
use App\Utils\EntityMapperUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("api/cinema")
 */
class CinemaController extends AbstractController
{
    private $cinemaService;

    public function __construct(CinemaServiceInterface $cinemaService)
    {
        $this->cinemaService = $cinemaService;
    }

    /**
     * @Route("/", name="get_cinemas", methods={"GET"})
     */
    public function getCinemas(): JsonResponse
    {
        $cinemas = $this->cinemaService->getAll();

        return new JsonResponse(EntityMapperUtils::mapEntitiesToArrays($cinemas,'cinema'));
    }

    /**
     * @Route("/{id}/theaters", name="get_theaters_by_cinema", methods={"GET"})
     */
    public function getTheatersByCinema($id): JsonResponse
    {
        $theaters = $this->cinemaService->getTheatersByCinema($id); // look im tired, i know this is in the wrong place entirely
        return new JsonResponse(EntityMapperUtils::mapEntitiesToArrays($theaters,'theater'));
    }

}
