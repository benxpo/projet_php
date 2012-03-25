<?php

namespace ComicReader\DesignBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use ComicReader\AdminBundle\Stuff\FullJoinBook;

class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
	$first = null;
	$second = null;
	$third = null;
	$fourth = null;
	$fifth = null;
	
	// get 3 last books
        $lastbooks = $this->getDoctrine()
                         ->getEntityManager()
                         ->getRepository('ComicReaderAdminBundle:Book')
                         ->findLast();
                $fullJoinBooks = array();
        
	$randomNumber = rand(0, count($lastbooks) - 1);
	
        $lastfullJoinBooks = array();
	$random = null;
	$i = 0;
        foreach ($lastbooks as $b)
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
	    
	    if ($i < 3)
		$lastfullJoinBooks[] = $fjb;
		
	    if ($i == $randomNumber)
		$random = $fjb;
	    $i++;
	    
	    
	    if ($fifth != null)
	    {
		if ($fbj->getMark() > $fifth->getMark())
		{
		    if ($fbj->getMark() > $third->getMark())
		    {
			if ($fbj->getMark() > $second->getMark())
			{
			    if ($fbj->getMark() > $first->getMark())
			    {
				$fifth = $fourth;
				$fourth = $third;
				$third = $second;
				$second = $first;
				$first = $fjb;
			    }
			    else
			    {
				$fifth = $fourth;
				$fourth = $third;
				$third = $second;
				$second = $fjb;
			    }
			}
			else
			{
			    $fifth = $fourth;
			    $fourth = $third;
			    $third = $fjb;
			}
		    }
		    else
		    {
			if ($fbj->getMark() > $fourth)
			{
			    $fifth = $fourth;
			    $fourth = $third;
			}
			else
			{
			    $fifth = $fourth;
			}
		    }
		}
	    }
	    else
	    {
		if ($first == null)
		{
		    $first = $fjb;
		}
		else if ($second == null)
		{
		    if ($fjb->getMark() > $first->getMark())
		    {
			$second = $first;
			$first = $fjb;
		    }
		    else
		    {
			$second = $fjb;
		    }
		}
		else if ($third == null)
		{
		    if ($fjb->getMark() > $second->getMark())
		    {
			$third = $second;
			if ($fjb->getMark() > $first->getMark())
			{
			    $second = $first;
			    $first = $fjb;
			}
			else
			{
			    $second = $fjb;
			}
		    }
		    else
		    {
			$third = $fjb;
		    }
		}
		else if ($fourth == null)
		{
		    if ($fjb->getMark() > $second->getMark())
		    {
			$fourth = $third;
			$third = $second;
			if ($fjb->getMark() > $first->getMark())
			{
			    $second = $first;
			    $first = $fjb;
			}
			else
			{
			    $second = $fjb;
			}
		    }
		    else
		    {
			if ($fjb->getMark() > $third->getMark())
			{
			    $fourth = $third;
			    $third = $fjb;
			}
			else
			{
			    $fourth = $fjb;
			}
		    }
		}
	    }
	}	
	
        $topfullJoinBooks = array();
	if ($first != null)
	{
	    $topfullJoinBooks[0] = $first;
	    if ($second != null)
	    {
	       $topfullJoinBooks[1] = $second;
	       if ($third != null)
	       {
		    $topfullJoinBooks[2] = $third;
		    if ($fourth != null)
		    {
			$topfullJoinBooks[3] = $fourth;
			if ($fifth != null)
			    $topfullJoinBooks[4] = $fifth;
		    }
	       }
	    }
	}
 
	return $this->render('ComicReaderDesignBundle:Index:'.$name.'.html.twig',
                             array('random' => $random,
				   'topbooks' => $topfullJoinBooks,
				   'lastbooks' => $lastfullJoinBooks));
    }
}
