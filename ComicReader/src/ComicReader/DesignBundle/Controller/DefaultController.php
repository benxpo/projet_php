<?php

namespace ComicReader\DesignBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    
    public function indexAction()
    {
	return $this->render('ComicReaderDesignBundle:Index:index.html.twig', array('nom' => 'winzou'));
    }
}
