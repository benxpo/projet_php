<?php

namespace ComicReader\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComicReader\AdminBundle\Entity\Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="ComicReader\AdminBundle\Entity\BookRepository")
 */
class Book
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var date $Date
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $Date;

    /**
     * @var string $ServerPath
     *
     * @ORM\Column(name="Server_Path", type="string", length=255)
     */
    private $ServerPath;

    /**
     * @var boolean $Validated
     *
     * @ORM\Column(name="Validated", type="boolean")
     */
    private $Validated;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->Date = $date;
    }

    /**
     * Get Date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * Set ServerPath
     *
     * @param string $serverPath
     */
    public function setServerPath($serverPath)
    {
        $this->ServerPath = $serverPath;
    }

    /**
     * Get ServerPath
     *
     * @return string 
     */
    public function getServerPath()
    {
        return $this->ServerPath;
    }

    /**
     * Set Validated
     *
     * @param boolean $validated
     */
    public function setValidated($validated)
    {
        $this->Validated = $validated;
    }

    /**
     * Get Validated
     *
     * @return boolean 
     */
    public function getValidated()
    {
        return $this->Validated;
    }
    public function __construct()
    {
	$this->Date =  new \DateTime('now');
	$this->Validated = False;
	$this->ServerPath = "";
    }
}
