<?php

namespace Limitless\KarhabtiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */

class Client
{
    /**
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * @ORM\Column(name="id",type="integer", nullable=false)
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(name="civilite",type="string",length=255, nullable=false)
     */

    private $civilite;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */

    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string",length=255, nullable=false)
     */
    private $prenom;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */

    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string",length=255, nullable=false)
     */

    private $ville;
    /**
     * @ORM\Column(name="codePostal", type="integer",nullable=false)
     */

    private $codePostal;
    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=false)
     */

    private $telephone;
    /**
     * @ORM\Column(name="dateNaissance",type="date", nullable=false)
     */

    private $dateNaissance;
    /**
     * @ORM\Column(name="villeNaissance", type="string", length=255, nullable=false)
     */

    private $villeNaissance;
    /**
     * @var boolean
     *
     * @ORM\Column(name="etatCode", type="boolean", nullable=false)
     */

    private $etatCode;
    /**
     * @ORM\ManyToOne(targetEntity="Moniteur")
     * @ORM\JoinColumn(name="moniteur_id",referencedColumnName="id")
     */
    private $moniteur;
    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;

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
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param string $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return mixed
     */
    public function getVilleNaissance()
    {
        return $this->villeNaissance;
    }

    /**
     * @param mixed $villeNaissance
     */
    public function setVilleNaissance($villeNaissance)
    {
        $this->villeNaissance = $villeNaissance;
    }

    /**
     * @return boolean
     */
    public function isEtatCode()
    {
        return $this->etatCode;
    }

    /**
     * @param boolean $etatCode
     */
    public function setEtatCode($etatCode)
    {
        $this->etatCode = $etatCode;
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }






}
