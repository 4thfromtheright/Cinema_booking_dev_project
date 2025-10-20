<?php


namespace App\Controller;

use App\Repository\CbBookingRepository;
use App\Repository\CbShowingsRepository;
use App\Service\Interfaces\BookingServiceInterface;
use App\Service\Interfaces\ShowingsServiceInterface;
use App\Service\ShowingsService;
use App\Utils\EntityMapperUtils;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/showings")
 */
class ShowingsController extends AbstractController
{
    private $showingsService;
    private $showingsRepository;
    private $bookingRepository;
    private $bookingService;

    public function __construct(ShowingsServiceInterface $showingsService, CbShowingsRepository $showingsRepository,CbBookingRepository $bookingRepository,BookingServiceInterface  $bookingService)
    {
        $this->showingsService = $showingsService;
        $this->showingsRepository = $showingsRepository;
        $this->bookingRepository = $bookingRepository;
        $this->bookingService = $bookingService;
    }


    /**
     * @Route("/{id}", name="get_showing", methods={"GET"})
     */
    public function getShowing(int $id): JsonResponse
    {
        try {
            $data = $this->showingsService->getShowingById($id);
            return new JsonResponse($data, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/theater/{id}", name="get_showings_by_theater", methods={"GET"})
     */
    public function getShowingsByTheater($id): JsonResponse
    {
        return new JsonResponse(EntityMapperUtils::mapEntitiesToArrays($this->showingsService->getShowingsByTheater($id), 'showing'));
    }

    /**
     * @Route("/film/{id}", name="get_showings_by_film", methods={"GET"})
     */
    public function getShowingsByFilm($id): JsonResponse
    {

        return new JsonResponse (EntityMapperUtils::mapEntitiesToArrays($this->showingsService->getShowingsByFilm($id), 'showing'));
    }






}
