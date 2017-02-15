<?php
/**
 * Created by PhpStorm.
 * User: WALA
 * Date: 05/02/2017
 * Time: 15:29
 */

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */


class Avis_client
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenue", type="string", length=255, nullable=false)
     */

    private $contenue;


    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */

    private $mail;



    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */

    private $nom;



    /**
     * @ORM\Column(name="choix_avis", type="boolean")
     */

    private $choix_avis;


    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id",referencedColumnName="id")
     */
    private $client;

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
    public function getContenue()
    {
        return $this->contenue;
    }

    /**
     * @param string $contenue
     */
    public function setContenue($contenue)
    {
        $this->contenue = $contenue;
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
     * @return mixed
     */
    public function getChoixAvis()
    {
        return $this->choix_avis;
    }

    /**
     * @param mixed $choix_avis
     */
    public function setChoixAvis($choix_avis)
    {
        $this->choix_avis = $choix_avis;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }



}