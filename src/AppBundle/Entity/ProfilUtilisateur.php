<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfilUtilisateur
 *
 * @ORM\Table(name="profil_utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfilUtilisateurRepository")
 */
class ProfilUtilisateur {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="motif", type="text")
     */
    private $motif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAttribution", type="datetime")
     */
    private $dateAttribution;

    /**
     * @ORM\ManyToOne(targetEntity="Profil")
     * @ORM\JoinColumn(name="profil_id", referencedColumnName="id")
     */
    private $profil;

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
     * Set motif
     *
     * @param string $motif
     *
     * @return ProfilUtilisateur
     */
    public function setMotif($motif) {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get motif
     *
     * @return string
     */
    public function getMotif() {
        return $this->motif;
    }

    /**
     * Set dateAttribution
     *
     * @param \DateTime $dateAttribution
     *
     * @return ProfilUtilisateur
     */
    public function setDateAttribution($dateAttribution) {
        $this->dateAttribution = $dateAttribution;

        return $this;
    }

    /**
     * Get dateAttribution
     *
     * @return \DateTime
     */
    public function getDateAttribution() {
        return $this->dateAttribution;
    }


    /**
     * Set profil
     *
     * @param \AppBundle\Entity\Profil $profil
     *
     * @return ProfilUtilisateur
     */
    public function setProfil(\AppBundle\Entity\Profil $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \AppBundle\Entity\Profil
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return ProfilUtilisateur
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
