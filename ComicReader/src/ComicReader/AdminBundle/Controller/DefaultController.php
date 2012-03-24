<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{   
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/reader/{bookid}")
     * @Template()
     */
    public function readerAction($bookid)
    {
        // FOR TESTS
        $book = "GLO_c106";
        
        $pages = array();
        for ($i=1;$i<3;$i++)
        {
            if ($i < 10)
                $path = sprintf("%s/%s_p0%d.png", $book, $book, $i);
            else
                $path = sprintf("%s/%s_p%d.png", $book, $book, $i);

            array_push($pages, array('id' => $i, 'path' => $path));
        }
        
        return $this->render('ComicReaderAdminBundle:Default:reader.html.twig',
                             array('bookid' => $bookid,
                                   'pages' => $pages));
    }
    
    /**
     * @Route("/nextpage/{bookid}/{lastpageid}")
     * @Template()
     */
    public function nextPageAction($bookid, $lastpageid)
    {
        // FOR TESTS
        $book = "GLO_c106";
        
        $session  = $this->get("session");
        
        if ($session->get('lastPageId') != $lastpageid + 1 ||
            $session->get('lastPageIdTime') + 10 <= time())
        {
            $id = intval($lastpageid) + 1;
            if ($id < 10)
                $path = sprintf("%s/%s_p0%d.png", $book, $book, $id);
            else
                $path = sprintf("%s/%s_p%d.png", $book, $book, $id);
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
     * @Route("/search/{value}/")
     * @Template()
     */
    public function searchAction($value)
    {
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
                             array('titlebooks' => $titlebooks,
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
