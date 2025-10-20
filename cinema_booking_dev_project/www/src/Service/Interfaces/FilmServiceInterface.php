<?php

namespace App\Service\Interfaces;

interface FilmServiceInterface
{
    public function getAll();

    public function getFilmById($id);

    public function getFilmsByTheater(int $theaterId): array;
}
