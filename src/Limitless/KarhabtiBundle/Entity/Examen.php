<?php
namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @ORM\JoinColumn(name="permis_id",referencedColumnName="id",nullable=true)
     */
    private $typePermis;

    /**
     * @param file string
     *
    @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Assert\Image(
     *     minWidth = "256",
     *     minHeight = "256",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png" ,"image/jpg"},
     *     mimeTypesMessage = "Le fichier choisi ne correspond pas à un fichier valide",
     * )
     */

    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question1" , referencedColumnName="id", onDelete="set null")
     */
    private $Question1;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question2" , referencedColumnName="id", onDelete="set null")
     */
    private $Question2;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question3" , referencedColumnName="id", onDelete="set null")
     */
    private $Question3;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question4" , referencedColumnName="id", onDelete="set null")
     */
    private $Question4;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question5" , referencedColumnName="id", onDelete="set null")
     */
    private $Question5;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question6" , referencedColumnName="id", onDelete="set null")
     */
    private $Question6;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question7" , referencedColumnName="id", onDelete="set null")
     */
    private $Question7;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question8" , referencedColumnName="id", onDelete="set null")
     */
    private $Question8;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question9" , referencedColumnName="id", onDelete="set null")
     */
    private $Question9;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn (name="Question10" , referencedColumnName="id", onDelete="set null")
     */
    private $Question10;


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

    function __toString()
    {
        return $this->getTitre();
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
    public function getQuestion1()
    {
        return $this->Question1;
    }

    /**
     * @param mixed $Question1
     */
    public function setQuestion1($Question1)
    {
        $this->Question1 = $Question1;
    }

    /**
     * @return mixed
     */
    public function getQuestion2()
    {
        return $this->Question2;
    }

    /**
     * @param mixed $Question2
     */
    public function setQuestion2($Question2)
    {
        $this->Question2 = $Question2;
    }

    /**
     * @return mixed
     */
    public function getQuestion3()
    {
        return $this->Question3;
    }

    /**
     * @param mixed $Question3
     */
    public function setQuestion3($Question3)
    {
        $this->Question3 = $Question3;
    }

    /**
     * @return mixed
     */
    public function getQuestion4()
    {
        return $this->Question4;
    }

    /**
     * @param mixed $Question4
     */
    public function setQuestion4($Question4)
    {
        $this->Question4 = $Question4;
    }

    /**
     * @return mixed
     */
    public function getQuestion5()
    {
        return $this->Question5;
    }

    /**
     * @param mixed $Question5
     */
    public function setQuestion5($Question5)
    {
        $this->Question5 = $Question5;
    }

    /**
     * @return mixed
     */
    public function getQuestion6()
    {
        return $this->Question6;
    }

    /**
     * @param mixed $Question6
     */
    public function setQuestion6($Question6)
    {
        $this->Question6 = $Question6;
    }

    /**
     * @return mixed
     */
    public function getQuestion7()
    {
        return $this->Question7;
    }

    /**
     * @param mixed $Question7
     */
    public function setQuestion7($Question7)
    {
        $this->Question7 = $Question7;
    }

    /**
     * @return mixed
     */
    public function getQuestion8()
    {
        return $this->Question8;
    }

    /**
     * @param mixed $Question8
     */
    public function setQuestion8($Question8)
    {
        $this->Question8 = $Question8;
    }

    /**
     * @return mixed
     */
    public function getQuestion9()
    {
        return $this->Question9;
    }

    /**
     * @param mixed $Question9
     */
    public function setQuestion9($Question9)
    {
        $this->Question9 = $Question9;
    }

    /**
     * @return mixed
     */
    public function getQuestion10()
    {
        return $this->Question10;
    }

    /**
     * @param mixed $Question10
     */
    public function setQuestion10($Question10)
    {
        $this->Question10 = $Question10;
    }




}