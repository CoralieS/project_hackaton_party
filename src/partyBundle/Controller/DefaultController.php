<?php

namespace partyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('partyBundle:Default:index.html.twig', array('name' => $name));
    }
}
