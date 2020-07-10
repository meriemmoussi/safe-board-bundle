<?php

namespace SafeBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SafeBoardBundle:Default:index.html.twig');
    }
}
