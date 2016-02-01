<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 01/02/2016
 * Time: 17:16
 */

namespace Joli\BlogBundle\Entity;


class Search
{
    private $recherche;
    private $published;

    public function __construct()
    {
        $this->recherche = "";
        $this->published = false;
    }

    public function getRecherche()
    {
        return $this->recherche;
    }

    public function setRecherche($recherche)
    {
        $this->recherche = $recherche;
    }

    public function published()
    {
        return $this->published;
    }

    public function setPublished($published) {
        $this->published = $published;
    }
}