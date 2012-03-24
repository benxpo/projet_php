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
     * @Route("/upload")
     * @Template()
     */
    public function uploadZipAction(Request $request)
    {
        $defaultData = array('manga_name' => 'Manga\'s name here');
        $form = $this->createFormBuilder($defaultData)
        ->add('author_name', 'text')
        ->add('manga_name', 'text')
        ->add('zip_file', 'file')
        ->getForm();
        
       // echo $request;
        
        if ($request->getMethod() == 'POST')
	{
            $form->bindRequest($request);

            $data = $form->getData();
            echo "Author name : ".$data['author_name']."<br />";
            echo "Manga name : ".$data['manga_name']."<br />";
        }
        
        return $this->render('ComicReaderAdminBundle:Default:upload.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
