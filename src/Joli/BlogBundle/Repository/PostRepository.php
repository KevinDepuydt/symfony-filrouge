<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 11/12/2015
 * Time: 10:51
 */

namespace Joli\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->add('select p')
            ->add('from', 'JoliBlog:Post p')
            ->add('where', 'p.isPublished = :published')
            ->setParameter('published', true)
            ->getQuery()
            ->getResult();
    }
}
