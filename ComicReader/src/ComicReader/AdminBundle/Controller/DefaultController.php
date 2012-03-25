<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use MyApp\FilmothequeBundle\Form\SearchForm;
use ComicReader\AdminBundle\Entity\Mark;

class DefaultController extends Controller
{
    /**
     * @Route("/reader/{bookid}")
     * @Template()
     */
    public function readerAction($bookid, Request $request)
    {
        $book = $this->getDoctrine()
                        ->getEntityManager()
                        ->getRepository('ComicReaderAdminBundle:Book')
                        ->find(intval($bookid));
        
        if ($book == null)
            return $this->render('ComicReaderAdminBundle:Default:error.html.twig');

        $author = $this->getDoctrine()
                        ->getEntityManager()
                        ->getRepository('ComicReaderAdminBundle:Author')
                        ->find($book->getId());
        
        $pages = array();
        for ($i=1;$i<3;$i++)
        {
            if ($i < 10)
                $path = sprintf("%s_p0%d.png", $book->getServerPath(), $i);
            else
                $path = sprintf("%s/%s_p%d.png", $book->getServerPath(), $i);

            array_push($pages, array('id' => $i, 'path' => $path));
        }

	/* Commentaires */

	$form = $this->createFormBuilder(array())
		->add('login', 'text')
		->add('mark', 'text')
		->add('comment', 'textarea')
		->getForm();

	if ($request->getMethod() == 'POST')
	{
		$form->bindRequest($request);
		$data = $form->getData();
		
		$login = htmlentities($date['login']);
		$mark = htmlentities($date['mark']);
		$comment = htmlentities($date['comment']);

		//ajout du comment ici
		$com = new Mark();
		$com->setComment($comment);
		$com->setMark($mark);

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($com);
		$em->flush();
	}
	
	/* Fin Commentaires */

        
        return $this->render('ComicReaderAdminBundle:Default:reader.html.twig',
                             array('bookid' => $bookid,
                                   'booktitle' => $book->getTitle(),
                                   'bookauthor' => $author->getName(),
                                   'pages' => $pages,
				   'form' => $form->createView()));
    }
    
    
    /**
     * @Route("/nextpage/{bookid}/{lastpageid}")
     * @Template()
     */
    public function nextPageAction($bookid, $lastpageid)
    {   
        $session  = $this->get("session");
        
        if ($session->get('lastPageId') != $lastpageid + 1 ||
            $session->get('lastPageIdTime') + 10 <= time())
        {
            
            $book = $this->getDoctrine()
                            ->getEntityManager()
                            ->getRepository('ComicReaderAdminBundle:Book')
                            ->find($bookid);
            
            $id = intval($lastpageid) + 1;
            if ($id < 10)
                $path = sprintf("%s_p0%d.png", $book->getServerPath(), $id);
            else
                $path = sprintf("%s/%s_p%d.png", $book->getServerPath(), $id);
            $page = array('id' => $id, 'path' => $path);
            
            $pages = array($page);
            
            $session->set('lastPageId', $id);
            $session->set('lastPageIdTime', time());
        
            return $this->render('ComicReaderAdminBundle:Default:one_page.html.twig',
                                 array("pages" => $pages));
            
        }
        return $this->render('ComicReaderAdminBundle:Default:empty.html.twig');
    }
    

    /**
     * @Route("/search/")
     * @Template()
     */
    public function searchAllAction()
    {   
        $books = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->findAllValidated();
                
        return $this->render('ComicReaderAdminBundle:Search:allBooks.html.twig',
                             array('books' => $books));
    }
    

    /**
     * @Route("/search/{value}/")
     * @Template()
     */
    public function searchAction($value)
    {
        $value = htmlentities($value);
        
        $titlebooks = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->searchTitle($value);

        $authorbooks = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Author')
                         ->searchAuthor($value);

        $descriptionbooks = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->searchDescription($value);
                
        return $this->render('ComicReaderAdminBundle:Search:result.html.twig',
                             array('searchvalue' => $value,
                                   'titlebooks' => $titlebooks,
                                   'authorbooks' => $authorbooks,
                                   'descriptionbooks' => $descriptionbooks));
    }
    
    
    /**
     * @Route("/author/{authorid}")
     * @Template()
     */
    public function authorAction($authorid)
    {
        $author = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Author')
                         ->find($authorid);
                         
        $books = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->searchAuthor($authorid);
                
        return $this->render('ComicReaderAdminBundle:Search:author.html.twig',
                             array('authorname' => $author->getName(),
                                   'books' => $books));
    }
}
