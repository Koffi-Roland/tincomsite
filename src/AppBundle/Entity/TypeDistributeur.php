<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeDistributeur
 *
 * @ORM\Table(name="type_distributeur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeDistributeurRepository")
 */
class TypeDistributeur
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;
    
    /**
     * @ORM\OneToMany(targetEntity="SousTypeDistributeur", mappedBy="typeDistributeur", cascade={"remove"})
     */
    private $sousTypeDistributeurs;
    
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return TypeDistributeur
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sousTypeDistributeurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sousTypeDistributeur
     *
     * @param \AppBundle\Entity\SousTypeDistributeur $sousTypeDistributeur
     *
     * @return TypeDistributeur
     */
    public function addSousTypeDistributeur(\AppBundle\Entity\SousTypeDistributeur $sousTypeDistributeur)
    {
        $this->sousTypeDistributeurs[] = $sousTypeDistributeur;

        return $this;
    }

    /**
     * Remove sousTypeDistributeur
     *
     * @param \AppBundle\Entity\SousTypeDistributeur $sousTypeDistributeur
     */
    public function removeSousTypeDistributeur(\AppBundle\Entity\SousTypeDistributeur $sousTypeDistributeur)
    {
        $this->sousTypeDistributeurs->removeElement($sousTypeDistributeur);
    }

    /**
     * Get sousTypeDistributeurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousTypeDistributeurs()
    {
        return $this->sousTypeDistributeurs;
    }
}
