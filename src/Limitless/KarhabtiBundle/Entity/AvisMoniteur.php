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

class AvisMoniteur
{
    /**
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * @ORM\Column(name="id",type="integer", nullable=false)
     */

    private $id;
    /**
     * @var string
     * @ORM\Column(name="contenu",type="string",length=255, nullable=false)
     */

    private $contenu;
    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */

    private $mail;
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
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
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