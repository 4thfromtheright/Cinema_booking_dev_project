<?php

namespace App\Service\Interfaces;

interface CinemaServiceInterface
{
    public function getAll();

    public function getTheatersByCinema($id);
}
