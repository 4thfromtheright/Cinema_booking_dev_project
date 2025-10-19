<?php

namespace App\Factory;

use App\Entity\CbSeats;
use Doctrine\ORM\EntityManagerInterface;

class CbSeatsFactory implements FactoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(array $data)
    {
        $entity = new CbSeats();
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($entity, $method)) {
                $entity->$method($value !== '' ? $value : null);
            }
        }
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function getById($id)
    {
        return $this->em->getRepository(CbSeats::class)->find($id);
    }

    public function getBy(array $criteria)
    {
        return $this->em->getRepository(CbSeats::class)->findBy($criteria);
    }

    public function update($entity, array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($entity, $method)) {
                $entity->$method($value !== '' ? $value : null);
            }
        }
        $this->em->flush();
        return $entity;
    }

    public function delete($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    public function findAll()
    {
        return $this->em->getRepository(CbSeats::class)->findAll();
    }
}
