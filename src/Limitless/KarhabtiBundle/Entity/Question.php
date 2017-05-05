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
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="categorie_id",referencedColumnName="id" ,nullable=true)
     */
    private $categorie;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Proposition3;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Proposition1;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Proposition2;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $repvrai;

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
    public function getProposition3()
    {
        return $this->Proposition3;
    }

    /**
     * @param mixed $Proposition3
     */
    public function setProposition3($Proposition3)
    {
        $this->Proposition3 = $Proposition3;
    }

    /**
     * @return mixed
     */
    public function getProposition1()
    {
        return $this->Proposition1;
    }

    /**
     * @param mixed $Proposition1
     */
    public function setProposition1($Proposition1)
    {
        $this->Proposition1 = $Proposition1;
    }

    /**
     * @return mixed
     */
    public function getProposition2()
    {
        return $this->Proposition2;
    }

    /**
     * @param mixed $Proposition2
     */
    public function setProposition2($Proposition2)
    {
        $this->Proposition2 = $Proposition2;
    }

    /**
     * @return mixed
     */
    public function getRepvrai()
    {
        return $this->repvrai;
    }

    /**
     * @param mixed $repvrai
     */
    public function setRepvrai($repvrai)
    {
        $this->repvrai = $repvrai;
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
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    function __toString()
    {
        return $this->getContenue();
    }


}