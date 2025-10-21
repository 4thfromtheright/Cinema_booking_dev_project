<?php
namespace App\Service\Interfaces;

interface TheaterServiceInterface
{
    public function getTheatersByCinema(int $cinemaId);

    public function getAll();
}