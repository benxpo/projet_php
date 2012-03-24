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
/*
	//Creation de l'objet

	$right = new T_Right();
	$right->setName("toto");
	echo $right->getName();

	//Enregistrement 

	$em = $this->getDoctrine()->getEntityManager();
	$em->persist($right);

	//refresh de la bdd 

	$em->flush();

	echo $right->getId();

	echo "<br/>";
*/
	//recuperation de la liste des entrées de la table t_right (voir find (id) findby(...))

	$t = $this->getDoctrine()->getRepository('ComicReaderAdminBundle:T_Right')->findAll();

	foreach($t as $g)	
		echo $g->getName()."<br/>";

	echo "<br/>";
      	return array();
    }
}
