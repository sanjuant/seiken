<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{
    public function findAllWithComments($page, $nbPerPage)
    {
        // On creer la requête avec des alias
        $qb = $this->createQueryBuilder('p')
                   ->select('c', 'p')
                   ->leftJoin("p.comments", 'c')
                   ->orderBy('p.date', 'DESC')
        ;

        // On recupère la requête
        $query = $qb->getQuery();

        // On défini le premier résultat, et le nombre de résultat maximum
        $query->setFirstResult(($page - 1) * $nbPerPage)// Début de la list
              ->setMaxResults($nbPerPage)// Nombre de résultat afficher
        ;

        // Pour finir on retourne un objet Paginator avec la réquête
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