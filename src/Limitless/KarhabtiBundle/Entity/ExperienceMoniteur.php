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

class ExperienceMoniteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */

    private $id;
    /**
     * @var string
     * @ORM\Column(name="libelle",type="string",length=255, nullable=false)
     */

    private $libelle;
    /**
     *
     * @var integer
     * @ORM\Column(name="anneeAnciennete", type="integer", nullable=false)
     */
    private $anneeAnciennete;
    /**
     * @var string
     * @ORM\Column(name="description",type="string",length=15, nullable=true)
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
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return int
     */
    public function getAnneeAnciennete()
    {
        return $this->anneeAnciennete;
    }

    /**
     * @param int $anneeAnciennete
     */
    public function setAnneeAnciennete($anneeAnciennete)
    {
        $this->anneeAnciennete = $anneeAnciennete;
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