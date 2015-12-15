<?php

namespace Joli\BlogBundle\Controller;

use Joli\BlogBundle\Entity\Post,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        /*$post = new Post();
        $post->setTitle('My super title')
             ->setBody('My super body shake '.$name)
             ->setIsPublished(true);*/

        $em = $this->getRepository();
        /*$em->persist($post);
        $em->flush();*/

        return [
            'name' => $name
        ];

    }

}
