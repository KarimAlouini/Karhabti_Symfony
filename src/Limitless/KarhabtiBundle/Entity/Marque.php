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

class Marque
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
    private $libelleMa;

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
    public function getLibelleMa()
    {
        return $this->libelleMa;
    }

    /**
     * @param mixed $libelleMa
     */
    public function setLibelleMa($libelleMa)
    {
        $this->libelleMa = $libelleMa;
    }

    function __toString()
    {
        return $this->getLibelleMa();
    }


}