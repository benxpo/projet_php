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
        $pages = array();
        for ($i=0;$i<40;$i++)
        {
            array_push($pages, array('id' => $i, 'path' => "toto $i"));
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
        $page = array('id' => intval($lastpageid) + 1,
                       'path' => "toto $lastpageid");
        $pages = array($page);
        
        return $this->render('ComicReaderAdminBundle:Default:one_page.html.twig',
                             array("pages" => $pages));
    }
}
