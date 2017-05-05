<?php

/**
 * Created by PhpStorm.
 * User: USER
 * Date: 20/03/2017
 * Time: 22:57
 */
namespace Limitless\KarhabtiBundle\Repository;
use Doctrine\ORM\EntityRepository;

class vehiculeRepository extends EntityRepository
{
    public function findVehiculeParameter($agence)
    {
        $query = $this->getEntityManager()
            ->createQuery("
            select v from PIKarhabtiBundle:Vehicule v WHERE v.agence=:agence
                          ")
            ->setParameter('agence',$agence);

        return $query->getResult();
    }

}