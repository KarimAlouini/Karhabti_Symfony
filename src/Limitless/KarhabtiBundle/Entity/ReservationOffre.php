<?php
/**
 * Created by PhpStorm.
 * User: ali methnani
 * Date: 05/02/2017
 * Time: 15:09
 */

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */



class ReservationOffre
{   /**
 * @var integer
 *
 * @ORM\Column(name="id", type="integer", nullable=false)
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */

    private $id;

    /**
     * @var integer
     * @ORM\Column(name="heureCodeS", type="integer",nullable=false)
     */
    private $heureCodeS;
    /**
     * @var integer
     * @ORM\Column(name="heureConduiteS", type="integer",nullable=false)
     */


    private $heureConduiteS;

    /**
     * @ORM\Column(name="prixTotale", type="float", nullable=true)
     */

    private $prixTotale;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id",referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Offre")
     * @ORM\JoinColumn(name="offre_id",referencedColumnName="id")
     */

    private $offre;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getHeureCodeS()
    {
        return $this->heureCodeS;
    }

    /**
     * @param int $heureCodeS
     */
    public function setHeureCodeS($heureCodeS)
    {
        $this->heureCodeS = $heureCodeS;
    }

    /**
     * @return int
     */
    public function getHeureConduiteS()
    {
        return $this->heureConduiteS;
    }

    /**
     * @param int $heureConduiteS
     */
    public function setHeureConduiteS($heureConduiteS)
    {
        $this->heureConduiteS = $heureConduiteS;
    }

    /**
     * @return mixed
     */
    public function getPrixTotale()
    {
        return $this->prixTotale;
    }

    /**
     * @param mixed $prixTotale
     */
    public function setPrixTotale($prixTotale)
    {
        $this->prixTotale = $prixTotale;
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
    public function getOffre()
    {
        return $this->offre;
    }

    /**
     * @param mixed $offre
     */
    public function setOffre($offre)
    {
        $this->offre = $offre;
    }








}