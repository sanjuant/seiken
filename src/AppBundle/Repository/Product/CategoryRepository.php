<?php

namespace AppBundle\Repository\Product;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function findAllWithProducts()
    {
//        $qb = $this->createQueryBuilder('c')
//                   ->select('p', 'c')
//                   ->innerJoin("c.products", 'p')
//                   ->where('c.id IN (:product.category_id)')
//                   ->setParameter('products.category_id', 'products.category_id')
//        ;

        $qb = $this->createQueryBuilder('c');


        $qb = $qb->select('p', 'c')
                 ->innerJoin("c.products", 'p')
                 ->where($qb->expr()->isNotNull('p.category'))
//                   ->andWhere('p.category IS NOT NULL')
        ;

//        dump($qb->getQuery());
//        die();
//        SELECT * FROM seiken.categories_product
//INNER JOIN seiken.products
//where seiken.categories_product.id
//in(seiken.products.category_id)

        return $qb->getQuery()->getResult();
    }
}