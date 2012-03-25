<?php

namespace ComicReader\DesignBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    
    public function indexAction($name)
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
 
	return $this->render('ComicReaderDesignBundle:Index:'.$name.'.html.twig',
                             array('books' => $fullJoinBooks));
    }
}
