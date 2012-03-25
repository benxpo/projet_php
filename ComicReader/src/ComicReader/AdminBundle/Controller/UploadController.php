<?php

namespace ComicReader\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use ComicReader\AdminBundle\Stuff\ZipHandler;

class UploadController extends Controller
{
    /**
     * @Route("/upload")
     * @Template()
     */
    public function uploadZipAction(Request $request)
    {
	$manga = NULL;
	$author = NULL;
	$filename = NULL;
	
	$defaultData = array(/*'manga_name' => 'Manga\'s name here'*/);
	$form = $this->createFormBuilder($defaultData)
		->add('author_name', 'text')
		->add('manga_name', 'text')
		->add('zip_file', 'file')
		->getForm();
	
        if ($request->getMethod() == 'POST')
	{
		$form->bindRequest($request);

		$data = $form->getData();
		$author = $data['author_name'];
		$manga = $data['manga_name'];
		$filename = $data['zip_file'];
		//$filename = $_FILES['form']['name']['zip_file'];
		$source = $_FILES['form']['tmp_name']['zip_file'];
		$type = $_FILES['form']['type']['zip_file'];
		 
		/*
		echo "Author name : ".$author."<br />";
		echo "Manga name : ".$manga."<br />";
		echo "Zip file : ".$filename."<br />";
		echo "File name : ".$filename."<br />";
		echo "source path : ".$source."<br />";
		echo "type : ".$type."<br />";
		*/
		
		// Check if the uploaded file is a Zip file
		$zip_types = array('application/zip', 'application/x-zip-compressed',
				'multipart/x-zip', 'application/s-compressed');  
		$isZip = false;
		foreach ($zip_types as $list_type)
		{
			if ($type == $list_type)
			{
				$isZip = true;
				break;
			}
		}
		if ($isZip == false)
		{
			echo "Please select a Zip file";
			return $this->render('ComicReaderAdminBundle:Default:upload.html.twig', array('form' => $form->createView(),));
		}
		
		// Unzip the file
		$zip = zip_open($filename);
		if (is_resource($zip) == false)
		{
			echo "Unable to open the Zip file";
			return $this->render('ComicReaderAdminBundle:Default:upload.html.twig', array('form' => $form->createView(),));
		}
		
		// Zip entry will be stored here
		$file_array = array();
		
		// Read the entry
		while ($zip_entry = zip_read($zip))
		{
			// Get the information on the file
			$filebytes = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
			$name = zip_entry_name($zip_entry);
			
			echo "Name : ".$name."<br />";
			//echo "PNG : ".$filebytes;
			
			// Check if the file is a PNG
			if (!($filebytes[0] == chr(137) && $filebytes[1] == chr(80) && $filebytes[2] == chr(78) &&
				$filebytes[3] == chr(71) && $filebytes[4] == chr(13) && $filebytes[5] == chr(10) &&
				$filebytes[6] == chr(26) && $filebytes[7] == chr(10)))
			{
				echo " - Not a PNG<br />";
				continue;
			}
			
			// Check if the name of the file correspond to the manga's name
			$temp = explode(".", $name);
			$shortname = substr($temp[0], 0, strlen($manga));
			if ($shortname != $manga)
			{
				echo " - Not a good name<br />";
				continue;
			}
			
			// Delete file which does not have valide number
			$num = substr($temp[0], strlen($shortname), strlen($temp[0]));
			if (!is_numeric($num))
			{
				echo " - Not a good number<br />";
				continue;
			}
			
			// Temporarily rename the file by its number
			$temp_name = intval($num);
			echo "--> New Name : ".$temp_name."<br />";
			
			$temp_array = array($temp_name, "png", $zip_entry);
			array_push($file_array, $temp_array);
		}
	
		// Rename and order the files
		$nb_file = 1;
		for ($n = 0; $n < count($file_array); ++$n)
		{
	
			$min_index = 0;
			$min_value = 1000000;
			for ($i = 0; $i < count($file_array); ++$i)
			{
				if (intval($file_array[$n][0]) < $min_value)
				{
					$min_value = intval($file_array[$n][0]);
					$min_index = $i;
				}
			}
		
			// Rename the file
			$file_array[$n][0] = $author."_".$manga."_".$nb_file.".".$file_array[$n][1];
			$nb_file += 1;
		}
		
		echo "New Names : <br />";
		for ($n = 0; $n < count($file_array); ++$n)
			echo $file_array[$n][0]."<br />";
        }
	
        return $this->render('ComicReaderAdminBundle:Default:upload.html.twig', array('form' => $form->createView(),));
    }
}
