<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class UploadController extends Controller
{
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
