<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TypeRepository extends EntityRepository
{
    public function findAllWithSizes()
    {
        $qb = $this->createQueryBuilder('t')
                   ->select('s', 't')
                   ->leftJoin("t.sizes", 's')
        ;

        return $qb->getQuery()->getResult();
    }
}