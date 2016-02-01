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
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Pagerfanta;

class ListController extends Controller
{
    /**
     * @Route("/blog/{page}", name="posts", defaults={"page"=1})
     * @Template("JoliBlogBundle:list:list.html.twig")
     */
    public function indexAction($page)
    {
        //$em = $this->get('doctrine.orm.entity_manager');
        //$posts = $em->getRepository('JoliBlogBundle:Post')->findAll();

        $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('Joli\BlogBundle\Entity\Post', 'p')
            ->where('p.isPublished = :published')
            ->setParameter('published', true);

        $adapter = new DoctrineORMAdapter($qb);
        $pagerfanta = new Pagerfanta($adapter);


        try {
            $entities = $pagerfanta
                ->setMaxPerPage(10)
                ->setCurrentPage($page)
                ->getCurrentPageResults();
        } catch (\Pagerfanta\Exception\NotValidCurrentPageException $e) {
            throw $this->createNotFoundException("Cette page n'existe pas.");
        }

        return array(
            'entities' => $entities,
            'pager' => $pagerfanta,
        );

        // return ['posts' => $posts];
    }
}