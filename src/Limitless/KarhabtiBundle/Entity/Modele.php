<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 04/02/2017
 * Time: 00:44
 */

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Modele
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=255, nullable=false)
     */
    private $libelleMo;
    /**
     * @ORM\ManyToOne(targetEntity="Marque")
     * @ORM\JoinColumn(name="marque_id",referencedColumnName="id")
     */
    private $marque;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLibelleMo()
    {
        return $this->libelleMo;
    }

    /**
     * @param mixed $libelleMo
     */
    public function setLibelleMo($libelleMo)
    {
        $this->libelleMo = $libelleMo;
    }

    /**
     * @return mixed
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param mixed $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    function __toString()
    {
        return $this->getLibelleMo();
    }


}