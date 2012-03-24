<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ComicReader\AdminBundle\Entity\T_Right;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     * @Template
     */
    public function indexAction()
    {
	$right = new T_Right();
	$right->setName("toto");
	echo $right->getName();

	$em = $this->getDoctrine()->getEntityManager();
	$em->persist($right);
	$em->flush();

	echo $right->getId();

	echo "<br/>";


	echo "<br/>";
      	return array();
    }
}
