<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ComicReader\AdminBundle\Stuff\Stuff;
use ComicReader\AdminBundle\Form;
use Symfony\Component\HttpFoundation\Request;
use ComicReader\AdminBundle\Entity\T_User;
use ComicReader\AdminBundle\Entity\Book;
use ComicReader\AdminBundle\Entity\Mark;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ComicReader\AdminBundle\Entity\Category;
use ComicReader\AdminBundle\Entity\Author;
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
			$session = $this->get("session");
			$login = $data['login'];
			$pass = md5($data['password']);

			$result = $this->getDoctrine()
			->getEntityManager()
			->getRepository('ComicReaderAdminBundle:T_User')
			->authentificate($login, $pass);

			if ($result)
			{
				$session = $this->get("session");
				$session->set('name', $login);
				return $this->redirect('menu');
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
		if ($name == "")
		{
			 return $this->redirect('login');
		}

		return array("name" => $name, "stat" => "Admin");


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
			return $this->redirect('login');
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

		return array('tab' => $tab);

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
			return $this->redirect('login');
		}
		$tab = $this->getDoctrine()
					->getEntityManager()
					->getRepository('ComicReaderAdminBundle:Book')
					->findAllValidated();
		echo "<table><tr><td>Name</td><td></td><td></td></tr>";
		foreach ($tab as $c)
		{
			echo "<tr><td>";
			echo $c->getTitle() . "</td><td>";
			echo "Modifier" . "</td><td>";
			echo "Supprimer" . "</td></tr>";
		}
		echo "</table>";

		return array();
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
			return $this->redirect('login');
		}
		$tab = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:T_User")->findAll();

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

		return array();
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
		//return $this->redirect('login');
	}

	$form = $this->createFormBuilder(array())
	->add('login', 'text')
	->add('password', 'text')
	->add('admin', 'checkbox', array("required" => false))
	->add('modo', 'checkbox', array("required" => false))
	->getForm();

        if ($request->getMethod() == 'POST')
	{
		$form->bindRequest($request);
    		$data = $form->getData();

		$login = $data['login'];
		$pass = $data['password'];
		$ad = 0;
		$mo = 0;

		$user = new T_User;
		$user->setLogin($login);
		$user->setis_Admin($ad);
		$user->setis_Mod($mo);
		$user->setPassword(md5($pass));

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($user);$em->flush();
		
	}
	return $this->render('ComicReaderAdminBundle:Admin:addU.html.twig',
			array('form' => $form->createView(),));
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
			return $this->redirect('login');
		}

		$form = $this->createFormBuilder(array())
		->add('login', 'text')
		->add('password', 'password')
		->getForm();

        if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
            $data = $form->getData();
			
			$login = $data['login'];


		}
 		return $this->render('ComicReaderAdminBundle:Admin:modU.html.twig',
				array('form' => $form->createView(),));
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
			return $this->redirect('login');
		}

		$form = $this->createFormBuilder(array())
		->add('login', 'text')
		->add('password', 'password')
		->getForm();

        if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
            $data = $form->getData();
			
			$login = $data['login'];


		}
 		return $this->render('ComicReaderAdminBundle:Admin:modB.html.twig',
				array('form' => $form->createView(),));
	}
}
