<?php

namespace ComicReader\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComicReader\AdminBundle\Entity\T_User
 *
 * @ORM\Table(name="t_user")
 * @ORM\Entity(repositoryClass="ComicReader\AdminBundle\Entity\T_UserRepository")
 */
class T_User
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
     * @var date $RegistrationDate
     *
     * @ORM\Column(name="Registration_Date", type="date")
     */
    private $RegistrationDate;

    /**
     * @var string $Login
     *
     * @ORM\Column(name="Login", type="string", length=255)
     */
    private $Login;

    /**
     * @var string $Password
     *
     * @ORM\Column(name="Password", type="string", length=40)
     */
    private $Password;


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
     * Set RegistrationDate
     *
     * @param date $registrationDate
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->RegistrationDate = $registrationDate;
    }

    /**
     * Get RegistrationDate
     *
     * @return date 
     */
    public function getRegistrationDate()
    {
        return $this->RegistrationDate;
    }

    /**
     * Set Login
     *
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->Login = $login;
    }

    /**
     * Get Login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->Login;
    }

    /**
     * Set Password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->Password = $password;
    }

    /**
     * Get Password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->Password;
    }
    public function __construct()
    {
	$this->RegistrationDate =  new \DateTime('now');
	$this->Login = "";
	$this->Password = "";
    }
}
