<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 11/12/2015
 * Time: 11:05
 */

namespace Joli\BlogBundle\ORM\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    Joli\BlogBundle\Entity\Post;

class LoadPostFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
            $post = new Post();
            $post->setTitle(sprintf('Titre du post n°%d', $i))
                 ->setBody(sprintf('Body du post n°%d', $i))
                 ->setIsPublished($i%2);

            $manager->persist($post);
        }

        $manager->flush();
    }
}