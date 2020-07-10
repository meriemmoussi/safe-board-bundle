<?php

namespace SafeBoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="SafeBoardBundle\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreRec", type="integer", nullable=true)
     */
    private $nombreRec;

    /**
     * @var int
     *
     * @ORM\Column(name="idAssociation", type="integer", nullable=true)
     */
    private $idAssociation;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", nullable=true)
     */
    private $idUser;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreRec
     *
     * @param integer $nombreRec
     *
     * @return Reclamation
     */
    public function setNombreRec($nombreRec)
    {
        $this->nombreRec = $nombreRec;

        return $this;
    }

    /**
     * Get nombreRec
     *
     * @return int
     */
    public function getNombreRec()
    {
        return $this->nombreRec;
    }

    /**
     * Set idAssociation
     *
     * @param integer $idAssociation
     *
     * @return Reclamation
     */
    public function setIdAssociation($idAssociation)
    {
        $this->idAssociation = $idAssociation;

        return $this;
    }

    /**
     * Get idAssociation
     *
     * @return int
     */
    public function getIdAssociation()
    {
        return $this->idAssociation;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Reclamation
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}

