<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 04/02/2017
 * Time: 13:27
 */

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TypeV
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
    private $libelleT;

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
    public function getLibelleT()
    {
        return $this->libelleT;
    }

    /**
     * @param mixed $libelleT
     */
    public function setLibelleT($libelleT)
    {
        $this->libelleT = $libelleT;
    }

    function __toString()
    {
        return $this->getLibelleT();

    }


}