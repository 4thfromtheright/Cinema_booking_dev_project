<?php
namespace App\Controller;

use App\Service\FactoryServiceProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class ConfirmationController extends AbstractController
{
    private $factoryProvider;

    public function __construct(FactoryServiceProviderInterface $factoryProvider)
    {
        $this->factoryProvider = $factoryProvider;
    }

    /**
     * @Route("/api/bookings/{id}/confirmation", name="api_booking_confirmation", methods={"GET"})
     */
    public function show($id): JsonResponse
    {
        $booking = $this->factoryProvider->getBookingFactory()->getById($id);
        if (!$booking) {
            return $this->json(['error' => 'Booking not found'], 404);
        }

        // For PDF generation, you can generate and send a URL to the frontend
        $pdfUrl = '/tickets/' . $booking->getBookingId() . '.pdf';

        return $this->json([
            'reference' => $booking->getBookingId(),
            'pdf_url' => $pdfUrl
        ]);
    }
}
