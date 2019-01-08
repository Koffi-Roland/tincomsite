<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Distributeur
 *
 * @ORM\Table(name="distributeur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DistributeurRepository")
 */
class Distributeur {

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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\ManyToOne(targetEntity="SousTypeDistributeur")
     * @ORM\JoinColumn(name="sousTypeDistributeur_id", referencedColumnName="id")
     */
    private $sousTypeDistributeur ;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", nullable = true)
     */
    private $latitude;
    
    /**
     * @var float
     *
     * @ORM\Column(name="lontitude", type="float", nullable = true)
     */
    private $longitude;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Distributeur
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }


    /**
     * Set sousTypeDistributeur
     *
     * @param \AppBundle\Entity\SousTypeDistributeur $sousTypeDistributeur
     *
     * @return Distributeur
     */
    public function setSousTypeDistributeur(\AppBundle\Entity\SousTypeDistributeur $sousTypeDistributeur = null)
    {
        $this->sousTypeDistributeur = $sousTypeDistributeur;

        return $this;
    }

    /**
     * Get sousTypeDistributeur
     *
     * @return \AppBundle\Entity\SousTypeDistributeur
     */
    public function getSousTypeDistributeur()
    {
        return $this->sousTypeDistributeur;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Distributeur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Distributeur
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Distributeur
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}
