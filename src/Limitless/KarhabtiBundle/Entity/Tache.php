<?php

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Tache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="heure_debut",type="datetime", nullable=false)
     */
    private $heure_debut;
    /**
     * @ORM\Column(name="heure_fin",type="datetime", nullable=false)
     */
    private $heure_fin;
    /**
     * @ORM\OneToOne(targetEntity="Vehicule")
     * @ORM\JoinColumn(name="vehicule_id",referencedColumnName="id")
     */
    private $vehicule;
    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id",referencedColumnName="id")
     */
    private $client;
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
    public function getHeureDebut()
    {
        return $this->heure_debut;
    }

    /**
     * @param mixed $heure_debut
     */
    public function setHeureDebut($heure_debut)
    {
        $this->heure_debut = $heure_debut;
    }

    /**
     * @return mixed
     */
    public function getHeureFin()
    {
        return $this->heure_fin;
    }

    /**
     * @param mixed $heure_fin
     */
    public function setHeureFin($heure_fin)
    {
        $this->heure_fin = $heure_fin;
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

