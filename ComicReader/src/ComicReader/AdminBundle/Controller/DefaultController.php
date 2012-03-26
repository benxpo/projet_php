<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use MyApp\FilmothequeBundle\Form\SearchForm;
use ComicReader\AdminBundle\Entity\Mark;
use ComicReader\AdminBundle\Stuff\FullJoinBook;

class DefaultController extends Controller
{
    /**
     * @Route("/reader/{bookid}")
     * @Template()
     */
    public function readerAction($bookid, Request $request)
    {
        $bookid = intval($bookid);
        
        // Get book
        $book = $this->getDoctrine()
                        ->getEntityManager()
                        ->getRepository('ComicReaderAdminBundle:Book')
                        ->find(intval($bookid));
        
        if ($book == null)
            return $this->render('ComicReaderAdminBundle:Default:error.html.twig');

        $author = $this->getDoctrine()
                        ->getEntityManager()
                        ->getRepository('ComicReaderAdminBundle:Author')
                        ->find($book->getFK_Author());
        
        // Get first pages
        $pages = array();
        for ($i=1;$i<3;$i++)
        {
            if ($i < 10)
                $path = sprintf("%s%d.png", $book->getServerPath(), $i);
            else
                $path = sprintf("%s%d.png", $book->getServerPath(), $i);

            array_push($pages, array('id' => $i, 'path' => $path));
        }

	/* Post comment 
	$form = $this->createFormBuilder(array())
		->add('login', 'text')
		->add('mark', 'text')
		->add('comment', 'textarea')
		->getForm();

	if ($request->getMethod() == 'POST')
	{
		$form->bindRequest($request);
		$data = $form->getData();
		
		$logincom = htmlentities($data['login']);
		$mark = htmlentities($data['mark']);
		$comment = htmlentities($data['comment']);

		//ajout du comment ici
		$com = new Mark();
		$com->setComment($comment);
		$com->setMark($mark);
		$com->setName($logincom);

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($com);
		$em->flush();
		
	}
	 End post comment*/

        // get mark and comment
        $comments = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Mark')
                         ->searchMarks($bookid);
        $mark = 0;
        $n = 0;
        foreach ($comments as $c)
        {
            $mark += $c->getMark();
            $n++;
        }
        
        // calculate stars
        $stars = array();
        if ($n > 0)
        {
            $mark = round($mark / $n, 1);
            for (; $mark >= 1.0; $mark--)
                $stars[] = "full_star";
            
            if ($mark >= 0.5)
                $stars[] = "half_star";
        }
        
        // Get uploader
        $uploader = $this->getDoctrine()
                            ->getEntityManager()
                            ->getRepository('ComicReaderAdminBundle:T_User')
                            ->find($book->getFK_User());

        
        return $this->render('ComicReaderAdminBundle:Default:reader.html.twig',
                             array('book' => $book,
                                   'thumbnail' => sprintf("%s01.png", $book->getServerPath()),
                                   'bookauthor' => $author->getName(),                         
                                   'stars' => $stars,
                                   'pages' => $pages,
                                   'comments' => $comments,
				   ));
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
                $path = sprintf("%s%d.png", $book->getServerPath(), $id);
            else
                $path = sprintf("%s%d.png", $book->getServerPath(), $id);
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
                $fullJoinBooks = array();
        
        $fullJoinBooks = array();
        foreach ($books as $b)
        {
            // Get author
            $author = $this->getDoctrine()
                        ->getEntityManager()
                        ->getRepository('ComicReaderAdminBundle:Author')
                        ->find($b->getFK_Author());

            // Get uploader
            $uploader = $this->getDoctrine()
                                ->getEntityManager()
                                ->getRepository('ComicReaderAdminBundle:T_User')
                                ->find($b->getFK_User());
                                
            // get mark and comment
            $comments = $this->getDoctrine()
                             ->getEntityManager()
                             ->getRepository('ComicReaderAdminBundle:Mark')
                             ->searchMarks($b->getId());
            
            $fjb = new FullJoinBook();
            $fjb->setBook($b);
            $fjb->setAuthor($author);
            $fjb->setUploader($uploader);
            $fjb->setComments($comments);
            $fullJoinBooks[] = $fjb;
        }
 
        return $this->render('ComicReaderAdminBundle:Search:allBooks.html.twig',
                             array('books' => $fullJoinBooks));
    }
    

    /**
     * @Route("/search/{value}/")
     * @Template()
     */
    public function searchAction($value)
    {
        $value = htmlentities($value);

        // Search in authors
        $authors = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Author')
                         ->searchAuthor($value);
        
        // Search in title
        $titlebooks = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->searchTitle($value);
        
        $fullJoinBooks = array();
        foreach ($titlebooks as $b)
        {
            // Get author
            $author = $this->getDoctrine()
                        ->getEntityManager()
                        ->getRepository('ComicReaderAdminBundle:Author')
                        ->find($b->getFK_Author());

            // Get uploader
            $uploader = $this->getDoctrine()
                                ->getEntityManager()
                                ->getRepository('ComicReaderAdminBundle:T_User')
                                ->find($b->getFK_User());
                                
            // get mark and comment
            $comments = $this->getDoctrine()
                             ->getEntityManager()
                             ->getRepository('ComicReaderAdminBundle:Mark')
                             ->searchMarks($b->getId());
            
            $fjb = new FullJoinBook();
            $fjb->setBook($b);
            $fjb->setAuthor($author);
            $fjb->setUploader($uploader);
            $fjb->setComments($comments);
            $fullJoinBooks[] = $fjb;
        }

        // Search in description
        $descriptionbooks = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->searchDescription($value);

        foreach ($descriptionbooks as $b)
        {
            // Get author
            $author = $this->getDoctrine()
                        ->getEntityManager()
                        ->getRepository('ComicReaderAdminBundle:Author')
                        ->find($b->getFK_Author());

            // Get uploader
            $uploader = $this->getDoctrine()
                                ->getEntityManager()
                                ->getRepository('ComicReaderAdminBundle:T_User')
                                ->find($b->getFK_User());
                                
            // get mark and comment
            $comments = $this->getDoctrine()
                             ->getEntityManager()
                             ->getRepository('ComicReaderAdminBundle:Mark')
                             ->searchMarks($b->getId());
            
            $fjb = new FullJoinBook();
            $fjb->setBook($b);
            $fjb->setAuthor($author);
            $fjb->setUploader($uploader);
            $fjb->setComments($comments);
            $fullJoinBooks[] = $fjb;
        }
        
        return $this->render('ComicReaderAdminBundle:Search:result.html.twig',
                             array('searchvalue' => $value,
                                   'authors' => $authors,
                                   'books' => $fullJoinBooks));
    }
    
    
    /**
     * @Route("/author/{authorid}")
     * @Template()
     */
    public function authorAction($authorid)
    {
        // get author
        $author = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Author')
                         ->find($authorid);
        
        // get book
        $books = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->searchAuthor($authorid);
        
        $fullJoinBooks = array();
        foreach ($books as $b)
        {
            // Get uploader
            $uploader = $this->getDoctrine()
                                ->getEntityManager()
                                ->getRepository('ComicReaderAdminBundle:T_User')
                                ->find($b->getFK_User());
                                
            // get mark and comment
            $comments = $this->getDoctrine()
                             ->getEntityManager()
                             ->getRepository('ComicReaderAdminBundle:Mark')
                             ->searchMarks($b->getId());
            
            $fjb = new FullJoinBook();
            $fjb->setBook($b);
            $fjb->setAuthor($author);
            $fjb->setUploader($uploader);
            $fjb->setComments($comments);
            $fullJoinBooks[] = $fjb;
        }
        
        return $this->render('ComicReaderAdminBundle:Search:author.html.twig',
                             array('authorname' => $author->getName(),
                                   'books' => $fullJoinBooks));
    }
}
