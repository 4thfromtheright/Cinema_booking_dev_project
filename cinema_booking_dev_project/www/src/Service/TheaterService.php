<?php


namespace App\Service;

use App\Repository\CbTheaterRepository;
use App\Repository\CbCinemaRepository;
use App\Service\Interfaces\TheaterServiceInterface;
use App\Utils\EntityMapperUtils;

class TheaterService implements TheaterServiceInterface
{
    private $theaterRepo;
    private $cinemaRepo;

    public function __construct(CbTheaterRepository $theaterRepo, CbCinemaRepository $cinemaRepo)
    {
        $this->theaterRepo = $theaterRepo;
        $this->cinemaRepo = $cinemaRepo;
    }

    public function getTheatersByCinema(int $cinemaId): array
    {
        $cinema = $this->cinemaRepo->find($cinemaId);
        if (!$cinema) {
            throw new \Exception("Cinema with ID $cinemaId not found");
        }


        $theaters = $this->theaterRepo->findBy(['cinema' => $cinema]);

        if (empty($theaters)) {
            return [];
        }

        return $theaters;
    }
}