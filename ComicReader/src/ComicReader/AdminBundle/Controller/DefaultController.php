<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @Route("/reader")
     * @Template()
     */
    public function readerAction()
    {
        // FOR TESTS
        $book = "GLO_c106";
        
        $pages = array();
        for ($i=1;$i<40;$i++)
        {
            if ($i < 10)
                $path = sprintf("%s/%s_p0%d.png", $book, $book, $i);
            else
                $path = sprintf("%s/%s_p%d.png", $book, $book, $i);

            array_push($pages, array('id' => $i, 'path' => $path));
        }
        
        return $this->render('ComicReaderAdminBundle:Default:reader.html.twig',
                             array('pages' => $pages));
    }
    
    /**
     * @Route("/nextpage/{bookid}/{lastpageid}")
     * @Template()
     */
    public function nextPageAction($bookid, $lastpageid)
    {
        // FOR TESTS
        $book = "GLO_c106";
        
        $i = intval($lastpageid) + 1;
        if ($i < 10)
            $path = sprintf("%s/%s_p0%d.png", $book, $book, $i);
        else
            $path = sprintf("%s/%s_p%d.png", $book, $book, $i);
            
        $page = array('id' => intval($lastpageid) + 1,
                       'path' => $path);
        
        $pages = array($page);
        
        return $this->render('ComicReaderAdminBundle:Default:one_page.html.twig',
                             array("pages" => $pages));
    }
}
