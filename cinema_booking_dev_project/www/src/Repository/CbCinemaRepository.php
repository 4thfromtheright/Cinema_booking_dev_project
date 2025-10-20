<?php
namespace App\Repository;

use App\Entity\CbCinema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CbCinemaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CbCinema::class);
    }

    public function save(CbCinema $cinema, bool $flush = true): void
    {
        $this->_em->persist($cinema);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(CbCinema $cinema, bool $flush = true): void
    {
        $this->_em->remove($cinema);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
