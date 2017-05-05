<?php
namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 */
class Cours
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
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank(message="")
     */

    private $contenue;
    /**
     * @ORM\Column(type="date")
     */
    private $dateajout;
    /**
     * @ORM\ManyToOne(targetEntity="Permis")
     * @ORM\JoinColumn(name="permis_id",referencedColumnName="id")
     */
    private $typePermis;
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

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
    public function getDateajout()
    {
        return $this->dateajout;
    }

    /**
     * @param mixed $dateajout
     */
    public function setDateajout($dateajout)
    {
        $this->dateajout = $dateajout;
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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    public  function __construct()
    {
        $this->dateajout=new \DateTime();
    }


}