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
     * @var $FK_User
     *
     * @ORM\ManyToOne(targetEntity="T_User")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $FK_User;

    /**
     * @var $FK_Author
     *
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $FK_Author;

    /**
     * @var $FK_Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
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

	$this->FK_User = null;
	$this->FK_Author = null;
	$this->FK_Category = null;
    }
}
