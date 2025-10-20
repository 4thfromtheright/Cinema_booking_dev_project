<?php
namespace App\Repository;

use App\Entity\CbFilms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CbFilmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CbFilms::class);
    }

    public function save(CbFilms $film, bool $flush = true): void
    {
        $this->_em->persist($film);
        if ($flush) $this->_em->flush();
    }

    public function remove(CbFilms $film, bool $flush = true): void
    {
        $this->_em->remove($film);
        if ($flush) $this->_em->flush();
    }
}
