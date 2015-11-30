<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 30/11/2015
 * Time: 09:48
 */

namespace AppBundle\Controller;

use Doctrine\DBAL\Driver\PDOSqlsrv\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class TimeController extends Controller
{
    /**
     * @Route("/current-time")
     */
    public function currentTimeAction()
    {
        return $this->render('current-time.html.twig', [
            'now' => new \DateTime('now')
        ]);
    }
}