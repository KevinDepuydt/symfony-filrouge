<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 01/02/2016
 * Time: 16:57
 */

namespace Joli\BlogBundle;

use Doctrine\ORM\EntityManager;

class SearchPosts
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function searchAll($str) {
        if (is_string($str)) {
            return $qb = $this->em->createQueryBuilder()
                ->select('p')
                ->from('Joli\BlogBundle\Entity\Post', 'p')
                ->where('p.title LIKE :search')
                ->orWhere('p.body LIKE :search')
                ->setParameter('search', '%'.$str.'%')
                ->getQuery()
                ->getResult();
        } else
            return false;
    }

    public function searchPublished($str) {
        if (is_string($str)) {
            return $qb = $this->em->createQueryBuilder()
                ->select('p')
                ->from('Joli\BlogBundle\Entity\Post', 'p')
                ->where('p.title LIKE :search')
                ->orWhere('p.body LIKE :search')
                ->setParameter('search', '%'.$str.'%')
                ->andWhere('p.isPublished = 1')
                ->getQuery()
                ->getResult();
        } else
            return false;
    }
}