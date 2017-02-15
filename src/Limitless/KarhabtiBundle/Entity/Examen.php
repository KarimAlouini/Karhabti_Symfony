<?php
namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */

class Examen
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
    private $titre;
    /**
     * @ORM\ManyToOne(targetEntity="Permis")
     * @ORM\JoinColumn(name="permis_id",referencedColumnName="id")
     */
    private $typePermis;

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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







}