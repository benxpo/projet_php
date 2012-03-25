<?php

namespace ComicReader\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComicReader\AdminBundle\Entity\Mark
 *
 * @ORM\Table(name="mark")
 * @ORM\Entity(repositoryClass="ComicReader\AdminBundle\Entity\MarkRepository")
 */
class Mark
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
     * @var integer $Mark
     *
     * @ORM\Column(name="Mark", type="integer", nullable=true)
     */
    private $Mark;
    /**
     * @var string $Name
     *
     * @ORM\Column(name="Name", type="string", length=100)
     */
    private $Name;
    /**
     * @var string $Comment
     *
     * @ORM\Column(name="Comment", type="string", length=1000, nullable=true)
     */
    private $Comment;
    /**
     * @var integer $FK_User
     *
     * @ORM\Column(name="FK_User", type="integer")
     */
    private $FK_User;
    /**
     * @var integer $FK_Book
     *
     * @ORM\Column(name="FK_Book", type="integer")
     */
    private $FK_Book;


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
     * Set Mark
     *
     * @param integer $mark
     */
    public function setMark($mark)
    {
        $this->Mark = $mark;
    }

    /**
     * Get Mark
     *
     * @return integer 
     */
    public function getMark()
    {
        return $this->Mark;
    }

    /**
     * Set Comment
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->Comment = $comment;
    }

    /**
     * Get Comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->Comment;
    }

    public function setName($comment)
    {
        $this->Name = $comment;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function setFK_User($comment)
    {
        $this->FK_User = $comment;
    }
    public function getFK_User()
    {
        return $this->FK_User;
    }
    public function setFK_Book($comment)
    {
        $this->FK_Book = $comment;
    }
    public function getFK_Book()
    {
        return $this->FK_Book;
    }
    public function __construct()
    {
	$this->Date =  new \DateTime('now');
	$this->Mark = 0;
	$this->Comment = "";
	$this->Name = "";

    	$this->FK_User = 0;
	$this->FK_Book = 0;
    }
}
