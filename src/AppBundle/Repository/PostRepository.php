<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findAllWithComments()
    {
        $qb = $this->createQueryBuilder('p')
                   ->select('c', 'p')
                   ->leftJoin("p.comments", 'c')
                   ->orderBy('p.date', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function findOneWithComments($id)
    {
        $qb = $this->createQueryBuilder('p')
                   ->select('c', 'p')
                   ->leftJoin("p.comments", 'c')
                   ->where("p.id = :id")
                   ->orderBy("c.date", 'DESC')
                   ->setParameter("id", $id)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}