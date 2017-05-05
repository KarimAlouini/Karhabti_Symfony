<?php

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255, nullable=false, unique=true)
     */
    private $matricule;
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $reserved=false;

    /**
     * @Assert\File(maxSize="6000k")
     */
    public $file;
    /**
     * @var \DateTime
     * @ORM\Column(name="dExp_assurance",type="date", nullable=false)
     */
    private $date_expiration_assurance;
    /**
     * @var \DateTime
     * @ORM\Column(name="dExp_vignette",type="date", nullable=false)
     */
    private $date_expiration_vignette;
    /**
     * @var \DateTime
     * @ORM\Column(name="dExp_visite",type="date", nullable=false)
     */
    private $date_expiration_visite;
    /**
     * @ORM\ManyToOne(targetEntity="Marque")
     * @ORM\JoinColumn(name="marque_id",referencedColumnName="id")
     */
    private $marque;
    /**
     * @ORM\ManyToOne(targetEntity="Modele")
     * @ORM\JoinColumn(name="modele_id",referencedColumnName="id")
     */
    private $modele;
    /**
     * @ORM\ManyToOne(targetEntity="TypeV")
     * @ORM\JoinColumn(name="typeV_id",referencedColumnName="id")
     */
    private $typeV;
    /**
     * @ORM\ManyToOne(targetEntity="Agence")
     * @ORM\JoinColumn(name="agence_id",referencedColumnName="id")
     */
    private $agence;

    /**
     * @return mixed
     */
    public function getReserved()
    {
        return $this->reserved;
    }

    /**
     * @param mixed $reserved
     */
    public function setReserved($reserved)
    {
        $this->reserved = $reserved;
    }



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
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param mixed $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }



    /**
     * @return \DateTime
     */
    public function getDateExpirationAssurance()
    {
        return $this->date_expiration_assurance;
    }

    /**
     * @param \DateTime $date_expiration_assurance
     */
    public function setDateExpirationAssurance($date_expiration_assurance)
    {
        $this->date_expiration_assurance = $date_expiration_assurance;
    }

    /**
     * @return \DateTime
     */
    public function getDateExpirationVignette()
    {
        return $this->date_expiration_vignette;
    }

    /**
     * @param \DateTime $date_expiration_vignette
     */
    public function setDateExpirationVignette($date_expiration_vignette)
    {
        $this->date_expiration_vignette = $date_expiration_vignette;
    }

    /**
     * @return \DateTime
     */
    public function getDateExpirationVisite()
    {
        return $this->date_expiration_visite;
    }

    /**
     * @param \DateTime $date_expiration_visite
     */
    public function setDateExpirationVisite($date_expiration_visite)
    {
        $this->date_expiration_visite = $date_expiration_visite;
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

    /**
     * @return mixed
     */
    public function getTypeV()
    {
        return $this->typeV;
    }

    /**
     * @param mixed $typeV
     */
    public function setTypeV($typeV)
    {
        $this->typeV = $typeV;
    }

    /**
     * @return mixed
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @param mixed $modele
     */
    public function setModele($modele)
    {
        $this->modele = $modele;
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
        return $this->getMatricule();
    }


}

