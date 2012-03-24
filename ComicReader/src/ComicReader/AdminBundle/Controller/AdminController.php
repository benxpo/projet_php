<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ComicReader\AdminBundle\Stuff\stuff;
use ComicReader\AdminBundle\Form;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     * @Template
     */
    public function indexAction()
    {
      	return array();
    }

    /**
     * @Route("/login")
     * @Template
     */
    public function loginAction(Request $request)
    {
		$form = $this->createFormBuilder(array())
		->add('login', 'text')
		->add('password', 'password')
		->getForm();

        if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
            $data = $form->getData();
			
			$login = $data['login'];
			$pass = md5($data['password']);

			$result = $this->getDoctrine()
			->getEntityManager()
			->getRepository('ComicReaderAdminBundle:T_User')
			->authentificate($pseudo, $pass);

			if ($result)
			{
				//go to page menu
				$session = $this->get("session");
				$session->set('name', 'login');
			}
			else
			{
				echo "Bad Login or Pass";
				$session->set('name', '');
			}

		}
 		return $this->render('ComicReaderAdminBundle:Admin:login.html.twig',
				array('form' => $form->createView(),));

    }

    /**
     * @Route("/menu")
     * @Template
     */
    public function menuAction()
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name <> "")
		{
			return array("name" => $name, "stat" => "Admin");
		}
		else
		{
			;//header vers page de connec
		}
	}

    /**
     * @Route("/deco")
     * @Template
     */
    public function decoAction()
    {
		$session = $this->get("session");
		$session->set('name', '');
		return array();
	}

    /**
     * @Route("/valid")
     * @Template
     */
    public function validAction(Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			;//header vers login
		}
		$tab = $this->getDoctrine()
					->getEntityManager()
					->getRepository('ComicReaderAdminBundle:Book')
					->findAllNotValidated();
		echo "<table><tr><td>Name</td><td>Desc</td><td></td><td></td></tr>";
		foreach ($tab as $c)
		{
			echo "<tr><td>";
			echo $c->getName() . "</td><td>";
			echo $c->getDescription() . "</td><td>";
			echo "Valider" . "</td><td>";
			echo "Supprimer" . "</td></tr>";
		}
		echo "</table>";

		return array();

	}

	/**
     * @Route("/book")
     * @Template
     */
    public function bookAction(Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			;//header vers login
		}
		$tab = $this->getDoctrine()
					->getEntityManager()
					->getRepository('ComicReaderAdminBundle:Book')
					->findAllValidated();
		echo "<table><tr><td>Name</td><td></td><td></td></tr>";
		foreach ($tab as $c)
		{
			echo "<tr><td>";
			echo $c->getName() . "</td><td>";
			echo "Modifier" . "</td><td>";
			echo "Supprimer" . "</td></tr>";
		}
		echo "</table>";
		echo ("");//lien vers ajouter book
	}
	/**
     * @Route("/user")
     * @Template
     */
    public function userAction(Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			;//header vers login
		}
		$tab = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:T_User")->findAll();
		//SQL recuperer liste
		echo "<table><tr><td>Login</td><td>Admin</td><td>Mod</td><td></td><td></td></tr>";
		foreach ($tab as $c)
		{
			echo "<tr><td>";
			echo $c->getLogin() . "</td><td>";
			echo $c->getis_Admin() . "</td><td>";
			echo $c->getis_Mod() . "</td><td>";
			echo "Modifier" . "</td><td>";
			echo "Supprimer" . "</td></tr>";
		}
		echo "</table>";
		echo ("");//lien vers ajouter user
	}
	/**
     * @Route("/addU")
     * @Template
     */
    public function addUAction(Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			;//header vers login
		}
	}
	/**
     * @Route("/modU")
     * @Template
     */
    public function modUAction(Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			;//header vers login
		}
	}
	/**
     * @Route("/addB")
     * @Template
     */
    public function addBAction(Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			;//header vers login
		}
	}
	/**
     * @Route("/modB")
     * @Template
     */
    public function modBAction(Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			;//header vers login
		}
	}
}
