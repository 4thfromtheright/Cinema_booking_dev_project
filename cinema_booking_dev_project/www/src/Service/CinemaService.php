<?php

namespace App\Service;

use App\Repository\CbCinemaRepository;
use App\Repository\CbTheaterRepository;
use App\Service\Interfaces\CinemaServiceInterface;

class CinemaService implements CinemaServiceInterface
{
    private $cinemaRepo;
    private $theaterRepo;

    public function __construct(CbCinemaRepository $cinemaRepo,CbTheaterRepository  $theaterRepo)
    {
        $this->theaterRepo=$theaterRepo;
        $this->cinemaRepo = $cinemaRepo;
    }

    public function getAll()
    {
        $cinemas = $this->cinemaRepo->findAll();



        return $cinemas;
    }

    public function getTheatersByCinema($id): array
    {
        $cinema = $this->cinemaRepo->find($id);
        if (!$cinema) {
            throw new \Exception("Cinema with ID $id not found");
        }

        return $this->theaterRepo->findBy(['cinema' => $cinema]);
    }

}
