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
    Pagerfanta\Pagerfanta,
    Pagerfanta\Exception\NotValidCurrentPageException,
    Joli\BlogBundle\Entity\Search;

class ListController extends Controller
{
    /**
     * @Template("JoliBlogBundle:list:list.html.twig")
     */
    public function indexAction($page)
    {
        $vars = [
            'form' => false,
            'search' => false,
            'searchExpression' => false,
            'countSearchResult' => 0,
            'posts' => false,
            'pager' => false
        ];

        $search = new Search();
        $form = $this->createFormBuilder($search)
            ->add('recherche', 'text', array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => "Saisir une expression à rechercher",
                )
            ))
            ->add('published', 'checkbox', array(
                'required' => false,
                'label' => "Articles publiés uniquement"
            ))
            ->add('save', 'submit', array('label' => 'Rechercher'))
            ->getForm();

        $form->handleRequest($this->get('request'));

        $vars['form'] = $form->createView();

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $str = $data->getRecherche();

            $searchPost = $this->get('search_post');

            if ($data->published())
                $searchResult = $searchPost->searchPublished($str);
            else
                $searchResult = $searchPost->searchAll($str);

            $vars['search'] = true;
            $vars['published'] = $data->published();
            $vars['searchExpression'] = $str;
            $vars['countSearchResult'] = count($searchResult);
            $vars['posts'] = $searchResult;

        } else {

            $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder()
                ->select('p')
                ->from('Joli\BlogBundle\Entity\Post', 'p')
                ->where('p.isPublished = :published')
                ->setParameter('published', true);

            $adapter = new DoctrineORMAdapter($qb);
            $pagerfanta = new Pagerfanta($adapter);

            try {
                $posts = $pagerfanta
                    ->setMaxPerPage(10)
                    ->setCurrentPage($page)
                    ->getCurrentPageResults();
            } catch (NotValidCurrentPageException $e) {
                throw $this->createNotFoundException("Cette page n'existe pas.");
            }

            $vars['posts'] = $posts;
            $vars['pager'] = $pagerfanta;
        }

        return $vars;
    }
}