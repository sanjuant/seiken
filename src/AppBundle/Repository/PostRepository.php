<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{
    public function findAllWithComments($page, $nbPerPage)
    {
        $qb = $this->createQueryBuilder('p')
                   ->select('c', 'p')
                   ->leftJoin("p.comments", 'c')
                   ->orderBy('p.date', 'DESC')
        ;

        $query = $qb->getQuery();

        $query->setFirstResult(($page - 1) * $nbPerPage)// We define the post from which to start the list
              ->setMaxResults($nbPerPage)// As well as the number of posts to display on a page
        ;

        // Finally, we return the Paginator object corresponding to the built request
        return new Paginator($query, true);
    }

    public function findOneWithComments($slug)
    {
        $qb = $this->createQueryBuilder('p')
                   ->select('c', 'p')
                   ->leftJoin("p.comments", 'c')
                   ->where("p.slug = :slug")
                   ->orderBy("c.date", 'DESC')
                   ->setParameter("slug", $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}