<?php
// src/Repository/CbShowingsRepository.php
namespace App\Repository;

use App\Entity\CbShowings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CbShowingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CbShowings::class);
    }



    public function save(CbShowings $showing, bool $flush = true): void
    {
        $this->_em->persist($showing);
        if ($flush) $this->_em->flush();
    }

    public function remove(CbShowings $showing, bool $flush = true): void
    {
        $this->_em->remove($showing);
        if ($flush) $this->_em->flush();
    }
}
