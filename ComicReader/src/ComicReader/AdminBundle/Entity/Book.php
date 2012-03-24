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
     * @var string $Description
     *
     * @ORM\Column(name="Description", type="string", length=1000)
     */
    private $Description;

    /**
     * @var string $Title
     *
     * @ORM\Column(name="Title", type="string", length=255)
     */
    private $Title;


    /**
     * @var boolean $Validated
     *
     * @ORM\Column(name="Validated", type="boolean")
     */
    private $Validated;

    /**
     * @var integer $FK_User
     *
     * @ORM\Column(name="FK_User", type="integer")
     */
    private $FK_User;

    /**
     * @var integer $FK_Author
     *
     * @ORM\Column(name="FK_Author", type="integer")
     */
    private $FK_Author;

    /**
     * @var integer $FK_Category
     *
     * @ORM\Column(name="FK_Category", type="integer")
     */
    private $FK_Category;

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

    public function setTitle($comment)
    {
        $this->Title = $comment;
    }
    public function getTitle()
    {
        return $this->Title;
    }
    public function setDescription($comment)
    {
        $this->Description = $comment;
    }
    public function getDescription()
    {
        return $this->Description;
    }

    public function setFK_User($comment)
    {
        $this->FK_User = $comment;
    }
    public function getFK_User()
    {
        return $this->FK_User;
    }
    public function setFK_Category($comment)
    {
        $this->FK_Category = $comment;
    }
    public function getFK_Category()
    {
        return $this->FK_Category;
    }
    public function setFK_Author($comment)
    {
        $this->FK_Author = $comment;
    }
    public function getFK_Author()
    {
        return $this->FK_Author;
    }

    public function __construct()
    {
	$this->Date =  new \DateTime('now');
	$this->Validated = False;
	$this->ServerPath = "";
	$this->Title = "";
	$this->Description = "";

	$this->FK_User = 0;
	$this->FK_Author = 0;
	$this->FK_Category = 0;
    }
}
