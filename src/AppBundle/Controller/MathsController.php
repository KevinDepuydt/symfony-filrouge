<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 30/11/2015
 * Time: 10:12
 */

namespace AppBundle\Controller;

use Doctrine\DBAL\Driver\PDOSqlsrv\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MathsController extends Controller
{
    public function squareAction($n)
    {
        $calculator = $this->get('calculator');
        return $this->render('square.html.twig', [
            'param' => $n,
            'result' => $calculator->square($n)
        ]);
    }
}