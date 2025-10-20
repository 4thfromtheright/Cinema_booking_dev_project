<?php
namespace App\Service\Interfaces;

interface ShowingsServiceInterface
{
    public function getAllShowings();
    public function getShowingsByTheater($id);

    public function getShowingsByFilm($id);

    public function getShowingById($id);

}
