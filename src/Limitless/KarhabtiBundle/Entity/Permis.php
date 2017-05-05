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
class Permis
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
    private $type;
    /**
     * @ORM\ManyToOne(targetEntity="Agence")
     * @ORM\JoinColumn(name="agence_id",referencedColumnName="id")
     */
    private $agence;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getAgence()
    {
        return $this->agence;
    }

    /**
     * @param mixed $agence
     */
    public function setAgence($agence)
    {
        $this->agence = $agence;
    }

    function __toString()
    {
        return $this->getType();
    }

}