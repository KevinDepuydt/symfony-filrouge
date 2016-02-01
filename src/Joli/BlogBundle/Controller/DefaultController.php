<?php

namespace Joli\BlogBundle\Controller;

use Joli\BlogBundle\Entity\Post,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Joli\BlogBundle\Repository\PostRepository;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return [
            'name' => $name
        ];
    }

}
