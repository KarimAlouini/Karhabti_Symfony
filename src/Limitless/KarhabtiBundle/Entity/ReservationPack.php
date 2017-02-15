<?php
/**
 * Created by PhpStorm.
 * User: ali methnani
 * Date: 05/02/2017
 * Time: 15:41
 */

namespace Limitless\KarhabtiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class ReservationPack
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id",referencedColumnName="id")
     */

    private $client;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Pack")
     * @ORM\JoinColumn(name="pack_id",referencedColumnName="id")
     */

    private $pack;

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
    public function getPack()
    {
        return $this->pack;
    }

    /**
     * @param mixed $pack
     */
    public function setPack($pack)
    {
        $this->pack = $pack;
    }





}