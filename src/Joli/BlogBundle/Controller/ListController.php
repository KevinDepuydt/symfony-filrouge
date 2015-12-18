<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 18/12/2015
 * Time: 10:32
 */

namespace Joli\BlogBundle\Controller;

use Joli\BlogBundle\Entity\Post,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ListController extends Controller
{
    /**
     * @Route("/blog")
     * @Template("JoliBlogBundle:list:list.html.twig")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $posts = $em->getRepository('JoliBlogBundle:Post')->findAll();

        return ['posts' => $posts];
    }
}