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

class EducationMoniteur
{
    /**
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * @ORM\Column(name="id",type="integer", nullable=false)
     */

    private $id;
    /**
     * @ORM\Column(name="niveauEtudes",type="date", nullable=false)
     */

    private $annee;
    /**
     *
     * @ORM\Column( type="string",length=255, nullable=false)
     */

    private $libelle;
    /**
     * @var string
     * @ORM\Column(type="string",length=255, nullable=true)
     */

    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="Moniteur")
     * @ORM\JoinColumn(name="moniteur_id",referencedColumnName="id")
     */
    private $moniteur;

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
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param mixed $annee
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    



}