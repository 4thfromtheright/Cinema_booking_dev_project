<?php

namespace App\Repository;

use App\Entity\CbTheater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CbTheaterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CbTheater::class);
    }

    public function save(CbTheater $theater, bool $flush = true): void
    {
        $this->_em->persist($theater);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function remove(CbTheater $theater, bool $flush = true): void
    {
        $this->_em->remove($theater);
        if ($flush) $this->_em->flush();
    }
}
