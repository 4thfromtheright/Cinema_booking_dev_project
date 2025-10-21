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


    public function __construct(ShowingsServiceInterface $showingsService)
    {
        $this->showingsService = $showingsService;

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

}
