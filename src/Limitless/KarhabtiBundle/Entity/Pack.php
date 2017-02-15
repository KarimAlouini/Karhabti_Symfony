<?php

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Pack
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
    private $nom;
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $nbr_heure_code;
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $nbr_heure_conduite;
    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $prixUcode;
    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $prixUconduite;
    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $prixtotal;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $image;
    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $promotion;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNbrHeureCode()
    {
        return $this->nbr_heure_code;
    }

    /**
     * @param mixed $nbr_heure_code
     */
    public function setNbrHeureCode($nbr_heure_code)
    {
        $this->nbr_heure_code = $nbr_heure_code;
    }

    /**
     * @return mixed
     */
    public function getNbrHeureConduite()
    {
        return $this->nbr_heure_conduite;
    }

    /**
     * @param mixed $nbr_heure_conduite
     */
    public function setNbrHeureConduite($nbr_heure_conduite)
    {
        $this->nbr_heure_conduite = $nbr_heure_conduite;
    }

    /**
     * @return mixed
     */
    public function getPrixUcode()
    {
        return $this->prixUcode;
    }

    /**
     * @param mixed $prixUcode
     */
    public function setPrixUcode($prixUcode)
    {
        $this->prixUcode = $prixUcode;
    }

    /**
     * @return mixed
     */
    public function getPrixUconduite()
    {
        return $this->prixUconduite;
    }

    /**
     * @param mixed $prixUconduite
     */
    public function setPrixUconduite($prixUconduite)
    {
        $this->prixUconduite = $prixUconduite;
    }

    /**
     * @return mixed
     */
    public function getPrixtotal()
    {
        return $this->prixtotal;
    }

    /**
     * @param mixed $prixtotal
     */
    public function setPrixtotal($prixtotal)
    {
        $this->prixtotal = $prixtotal;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * @param mixed $promotion
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
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

}

