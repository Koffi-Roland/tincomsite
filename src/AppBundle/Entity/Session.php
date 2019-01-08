<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Table(name="session")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SessionRepository")
 */
class Session {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateConnexion", type="datetime")
     */
    private $dateConnexion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeconnexion", type="datetime", nullable=true)
     */
    private $dateDeconnexion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDerniereConnexion", type="datetime", nullable=true)
     */
    private $dateDerniereConnexion;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    private $utilisateur;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dateConnexion
     *
     * @param \DateTime $dateConnexion
     *
     * @return Session
     */
    public function setDateConnexion($dateConnexion) {
        $this->dateConnexion = $dateConnexion;

        return $this;
    }

    /**
     * Get dateConnexion
     *
     * @return \DateTime
     */
    public function getDateConnexion() {
        return $this->dateConnexion;
    }

    /**
     * Set dateDeconnexion
     *
     * @param \DateTime $dateDeconnexion
     *
     * @return Session
     */
    public function setDateDeconnexion($dateDeconnexion) {
        $this->dateDeconnexion = $dateDeconnexion;

        return $this;
    }

    /**
     * Get dateDeconnexion
     *
     * @return \DateTime
     */
    public function getDateDeconnexion() {
        return $this->dateDeconnexion;
    }

    /**
     * Set dateDerniereConnexion
     *
     * @param \DateTime $dateDerniereConnexion
     *
     * @return Session
     */
    public function setDateDerniereConnexion($dateDerniereConnexion) {
        $this->dateDerniereConnexion = $dateDerniereConnexion;

        return $this;
    }

    /**
     * Get dateDerniereConnexion
     *
     * @return \DateTime
     */
    public function getDateDerniereConnexion() {
        return $this->dateDerniereConnexion;
    }


    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Session
     */
    public function setUtilisateur(\AppBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
