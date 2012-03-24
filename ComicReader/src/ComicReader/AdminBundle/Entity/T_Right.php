<?php

namespace ComicReader\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComicReader\AdminBundle\Entity\T_Right
 *
 * @ORM\Table(name="t_right")
 * @ORM\Entity(repositoryClass="ComicReader\AdminBundle\Entity\T_RightRepository")
 */
class T_Right
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
     * @var string $Name
     *
     * @ORM\Column(name="Name", type="string", length=16)
     */
    private $Name;

    /**
     * @var integer $R
     *
     * @ORM\Column(name="R", type="integer")
     */
    private $R;

    /**
     * @var integer $U
     *
     * @ORM\Column(name="U", type="integer")
     */
    private $U;

    /**
     * @var integer $V
     *
     * @ORM\Column(name="V", type="integer")
     */
    private $V;

    /**
     * @var integer $D
     *
     * @ORM\Column(name="D", type="integer")
     */
    private $D;


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
     * Set Name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->Name = $name;
    }

    /**
     * Get Name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set R
     *
     * @param integer $r
     */
    public function setR($r)
    {
        $this->R = $r;
    }

    /**
     * Get R
     *
     * @return integer 
     */
    public function getR()
    {
        return $this->R;
    }

    /**
     * Set U
     *
     * @param integer $u
     */
    public function setU($u)
    {
        $this->U = $u;
    }

    /**
     * Get U
     *
     * @return integer 
     */
    public function getU()
    {
        return $this->U;
    }

    /**
     * Set V
     *
     * @param integer $v
     */
    public function setV($v)
    {
        $this->V = $v;
    }

    /**
     * Get V
     *
     * @return integer 
     */
    public function getV()
    {
        return $this->V;
    }

    /**
     * Set D
     *
     * @param integer $d
     */
    public function setD($d)
    {
        $this->D = $d;
    }

    /**
     * Get D
     *
     * @return integer 
     */
    public function getD()
    {
        return $this->D;
    }
    public function __construct()
    {
	$this->Name = "";
	$this->R = 0;
	$this->U = 0;
	$this->V = 0;
	$this->D = 0;
    }
}
