<?php

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Offre
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
    private $prixUcode;
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $prixUconduite;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="Vehicule")
     * @ORM\JoinColumn(name="vehicule_id",referencedColumnName="id")
     */
    private $vehicule;
    /**
     * @ORM\ManyToOne(targetEntity="Moniteur")
     * @ORM\JoinColumn(name="moniteur_id",referencedColumnName="id")
     */
    private $moniteur;
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
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * @param mixed $vehicule
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;
    }


    /**
     * @return mixed
     */
    public function getMoniteur()
    {
        return $this->moniteur;
    }

    /**
     * @param mixed $moniteur
     */
    public function setMoniteur($moniteur)
    {
        $this->moniteur = $moniteur;
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

