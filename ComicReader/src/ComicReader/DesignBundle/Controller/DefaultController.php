<?php

namespace ComicReader\DesignBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use ComicReader\AdminBundle\Stuff\FullJoinBook;

class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
	// get 2 last books=
        $lastbooks = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->findLast();
                $fullJoinBooks = array();
        
        $lastfullJoinBooks = array();
	$i = 0;
        foreach ($lastbooks as $b)
        {
	    if ($i = 2)
		break;
	    $i++;
	    
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
            $lastfullJoinBooks[] = $fjb;
        }
 
	return $this->render('ComicReaderDesignBundle:Index:'.$name.'.html.twig',
                             array('books' => $lastfullJoinBooks,
				   'lastbooks' => $lastfullJoinBooks));
    }
}
