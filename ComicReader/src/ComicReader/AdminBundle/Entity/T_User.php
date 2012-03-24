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
     * @var boolean $is_Admin
     *
     * @ORM\Column(name="is_Admin", type="boolean")
     */
    private $is_Admin;

    /**
     * @var boolean $is_Mod
     *
     * @ORM\Column(name="is_Mod", type="boolean")
     */
    private $is_Mod;

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


    public function setis_Mod($password)
    {
        $this->is_Mod = $password;
    }

    public function getis_Mod()
    {
        return $this->is_Mod;
    }

    public function setis_Admin($password)
    {
        $this->is_Admin = $password;
    }

    public function getis_Admin()
    {
        return $this->is_Admin;
    }

    public function __construct()
    {
	$this->RegistrationDate =  new \DateTime('now');
	$this->Login = "";
	$this->Password = "";
	$this->is_Admin = false;
	$this->is_Mod = false;
    }
}
