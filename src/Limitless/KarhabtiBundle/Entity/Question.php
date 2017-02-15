<?php
namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Question
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
     private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
      private $contenue;
    /**
     * @ORM\ManyToOne(targetEntity="Permis")
     * @ORM\JoinColumn(name="permis_id",referencedColumnName="id")
     */
    private $typePermis;

    /**
     * @ORM\ManyToOne(targetEntity="Examen")
     * @ORM\JoinColumn(name="examen_id",referencedColumnName="id")
     */
    private $examen;

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
    public function getContenue()
    {
        return $this->contenue;
    }

    /**
     * @param mixed $contenue
     */
    public function setContenue($contenue)
    {
        $this->contenue = $contenue;
    }

    /**
     * @return mixed
     */
    public function getTypePermis()
    {
        return $this->typePermis;
    }

    /**
     * @param mixed $typePermis
     */
    public function setTypePermis($typePermis)
    {
        $this->typePermis = $typePermis;
    }

    /**
     * @return mixed
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * @param mixed $examen
     */
    public function setExamen($examen)
    {
        $this->examen = $examen;
    }





}