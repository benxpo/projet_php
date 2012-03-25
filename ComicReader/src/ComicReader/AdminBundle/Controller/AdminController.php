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
		->add('login', 'text', array())
		->add('password', 'password', array())
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

				$r2 = $this->getDoctrine()
					->getEntityManager()
					->getRepository('ComicReaderAdminBundle:T_User')
					->getUser($login);
				if ($r2->getis_Admin())
					$session->set('stat', 'admin');
				else
					$session->set('stat', 'modo');
				return $this->redirect('menu');
			}
			else
			{
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
		$stat = $session->get('stat');
		if ($name == "")
		{
			 return $this->redirect('login');
		}
		
		   return array("name" => $name, "stat" => $stat);



	}

    /**
     * @Route("/deco")
     * @Template
     */
    public function decoAction()
    {
		$session = $this->get("session");
		$session->set('name', '');
		$session->set('stat', "");
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

		return array('tab' => $tab);
	}
	/**
     * @Route("/comment/{id}")
     * @Template
     */
    public function commentAction($id,Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			return $this->redirect('login');
		}
		$tab = $this->getDoctrine()
			->getEntityManager()
			->getRepository('ComicReaderAdminBundle:Mark')
			->searchMarks($id);

		return array('tab' => $tab);
	}

    /**
     * @Route("/delC/{id}")
     */
    public function delCAction($id, Request $request)
    {
	$session = $this->get("session");
	$name = $session->get('name');
	if ($name == "")
	{
		return $this->redirect('../login');
	}
	if ($session->get('stat') != "admin")
	{
		return $this->redirect('../menu');
	}
	$user = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:Mark")->find($id);

	$em = $this->getDoctrine()->getEntityManager();
	$em->remove($user);$em->flush();
	

	return $this->redirect('../comment');
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
		if ($session->get('stat') != "admin")
		{
			return $this->redirect('menu');
		}
		$tab = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:T_User")->findAll();

		return array('tab' => $tab);
	}

    /**
     * @Route("/delU/{id}")
     */
    public function delUAction($id, Request $request)
    {
	$session = $this->get("session");
	$name = $session->get('name');
	if ($name == "")
	{
		return $this->redirect('../login');
	}
	if ($session->get('stat') != "admin")
	{
		return $this->redirect('../menu');
	}
	$user = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:T_User")->find($id);

	$em = $this->getDoctrine()->getEntityManager();
	$em->remove($user);$em->flush();
	

	return $this->redirect('../user');
    }

    /**
     * @Route("/delB/{id}")
     */
    public function delBAction($id, Request $request)
    {
	$session = $this->get("session");
	$name = $session->get('name');
	if ($name == "")
	{
		return $this->redirect('../login');
	}

	$user = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:Book")->find($id);

	$em = $this->getDoctrine()->getEntityManager();
	$em->remove($user);$em->flush();
	

	return $this->redirect('../book');
    }
    /**
     * @Route("/valB/{id}")
     */
    public function valBAction($id, Request $request)
    {
	$session = $this->get("session");
	$name = $session->get('name');
	if ($name == "")
	{
		return $this->redirect('../login');
	}

	$book = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:Book")->find($id);
	$book->setValidated(1);
	$em = $this->getDoctrine()->getEntityManager();
	$em->persist($book);$em->flush();
	

	return $this->redirect('../valid');
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
		return $this->redirect('login');
	}
	if ($session->get('stat') != "admin")
	{
		return $this->redirect('menu');
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
		if ($data['admin'])
			$ad = true;
		else
			$ad = false;
		if ($data['modo'])
			$mo = true;
		else
			$mo = false;

		$user = new T_User;
		$user->setLogin($login);
		$user->setis_Admin($ad);
		$user->setis_Mod($mo);
		$user->setPassword(md5($pass));

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($user);$em->flush();
		return $this->redirect('user');	
	}
	return $this->render('ComicReaderAdminBundle:Admin:addU.html.twig',
			array('form' => $form->createView(),));
    }
    /**
     * @Route("/modU/{id}")
     * @Template
     */
    public function modUAction($id, Request $request)
    {
	$session = $this->get("session");
	$name = $session->get('name');
	if ($name == "")
	{
		return $this->redirect('../login');
	}
	if ($session->get('stat') != "admin")
	{
		return $this->redirect('../menu');
	}
	$user = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:T_User")->
			find($id);
	$form = $this->createFormBuilder(array('login' => $user->getLogin()))
	->add('login', 'text', array("required" => false))
	->add('password', 'text', array("required" => false))
	->add('admin', 'checkbox', array("required" => false))
	->add('modo', 'checkbox', array("required" => false))
	->getForm();

	if ($request->getMethod() == 'POST')
	{
		$form->bindRequest($request);	
   		$data = $form->getData();



		if ($data['admin'])
			$user->setis_Admin(1);
		else
			$user->setis_Admin(0);

		if ($data['modo'])
			$user->setis_Mod(1);
		else
			$user->setis_Mod(0);
		if (isset($data['login']))
			$user->setLogin($data['login']);
		if (isset($data['password']))
			$user->setPassword(md5($data['password']));

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($user);$em->flush();
		

		return $this->redirect('../user');				
	}

	return $this->render('ComicReaderAdminBundle:Admin:modU.html.twig',
			array('id' => $id,'form' => $form->createView(),));
    }

	/**
     * @Route("/modB/{id}")
     * @Template
     */
    public function modBAction($id, Request $request)
    {
		$session = $this->get("session");
		$name = $session->get('name');
		if ($name == "")
		{
			return $this->redirect('../login');
		}
		
		$bo = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:Book")->find($id);
		$form = $this->createFormBuilder(array("title" => $bo->getTitle(),
					 "description" => $bo->getDescription()))
		->add('title', 'text', array("required" => false))
		->add('description', 'textarea', array("required" => false))
		->getForm();

        	if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);	
           		$data = $form->getData();

			$b = $this->getDoctrine()->getRepository("ComicReaderAdminBundle:Book")->
					find($id);

			if (isset($data['title']))
				$b->setTitle($data['title']);
			if (isset($data['description']))
				$b->setDescription($data['description']);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($b);$em->flush();
			

			return $this->redirect('../book');				
		}

 		return $this->render('ComicReaderAdminBundle:Admin:modB.html.twig',
				array('id' => $id,'form' => $form->createView(),));
	}
}
