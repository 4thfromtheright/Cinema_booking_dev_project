<?php

namespace App\Service;

use App\Repository\CbFilmsRepository;
use App\Repository\CbShowingsRepository;
use App\Repository\CbTheaterRepository;
use App\Service\Interfaces\FilmServiceInterface;

class FilmService implements FilmServiceInterface
{
    private $filmsRepo;
    private $showingsRepo;
    private $theaterRepo;

    public function __construct(
        CbFilmsRepository $filmsRepo,
        CbShowingsRepository $showingsRepo,
        CbTheaterRepository $theaterRepo
    ) {
        $this->filmsRepo = $filmsRepo;
        $this->showingsRepo = $showingsRepo;
        $this->theaterRepo = $theaterRepo;
    }


    public function getAll()
    {
        return $this->filmsRepo->findAll();
    }

    public function getFilmById($id)
    {
        $films=$this->filmsRepo->findBy(['film_id' => $id]);
        if(!$films){
            throw new \Exception('film not found');
        }
        return $films;

    }

    public function getFilmsByTheater(int $theaterId): array
    {
        // Find the theater first
        $theater = $this->theaterRepo->find($theaterId);
        if (!$theater) {
            throw new \Exception("Theater with ID $theaterId not found");
        }

        // Get showings for this theater, then extract unique films
        $showings = $this->showingsRepo->findBy(['theater' => $theater]);

        if (empty($showings)) {
            return [];
        }

        // Extract unique films from showings
        $films = [];
        $filmIds = [];

        foreach ($showings as $showing) {
            $film = $showing->getFilm();
            if ($film && !in_array($film->getFilmId(), $filmIds)) {
                $films[] = $film;
                $filmIds[] = $film->getFilmId();
            }
        }

        return $films;
    }
}
