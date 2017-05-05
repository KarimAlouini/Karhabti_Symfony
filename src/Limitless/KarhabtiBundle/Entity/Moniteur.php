<?php
/**
 * Created by PhpStorm.
 * User: KHALIL-PC
 * Date: 05/02/2017
 * Time: 13:28
 */

namespace Limitless\KarhabtiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Moniteur
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
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */

    private $mail;
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=false)
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
     * @var  \DateTime
     * @ORM\Column(name="dateNaissance",type="date", nullable=false)
     */

    private $dateNaissance;
    /**
     * @var string
     *
     * @ORM\Column(name="lieuNaissance", type="string", length=255, nullable=false)
     */

    private $lieuNaissance;
    /**
     * @ORM\ManyToOne(targetEntity="Agence")
     * @ORM\JoinColumn(name="agence_id",referencedColumnName="id")
     */
    private $agence;
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
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
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
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param \DateTime $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return string
     */
    public function getLieuNaissance()
    {
        return $this->lieuNaissance;
    }

    /**
     * @param string $lieuNaissance
     */
    public function setLieuNaissance($lieuNaissance)
    {
        $this->lieuNaissance = $lieuNaissance;
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
    function __toString()
    {
        return $this->getNom().' '.$this->getPrenom();
    }




}