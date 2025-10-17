<?php

namespace App\Factory;

use App\Entity\CbShowings;
use Doctrine\ORM\EntityManagerInterface;

class CbShowingsFactory implements FactoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(array $data)
    {
        $entity = new CbShowings();
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
        return $this->em->getRepository(CbShowings::class)->find($id);
    }

    public function getBy(array $criteria)
    {
        return $this->em->getRepository(CbShowings::class)->findBy($criteria);
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
}
