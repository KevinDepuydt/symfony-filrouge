<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 01/02/2016
 * Time: 09:16
 */

namespace Joli\BlogBundle\Controller;

use Joli\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class ProposeController extends Controller
{
    /**
     * @Template("JoliBlogBundle:propose:propose.html.twig")
     */
    public function proposeAction(Request $request)
    {
        $message = "Veuillez remplir le formulaire pour poster un article";
        $post = new Post();
        $form = $this->createFormBuilder($post)
            ->add('title', 'text')
            ->add('body', 'text')
            ->add('slug', 'text')
            ->add('published', 'checkbox', array(
                'required' => false,
            ))
            ->add('save', 'submit', array('label' => 'Create post'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $message = "L'article à été posté avec succès";
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $message = "Veuillez remplir le formulaire correctement";
        }
        return array(
            'form' => $form->createView(),
            'message' => $message
        );
    }
}