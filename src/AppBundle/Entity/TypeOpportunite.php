<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeOpportunite
 *
 * @ORM\Table(name="type_opportunite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeOpportuniteRepository")
 */
class TypeOpportunite {

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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Poste")
     * @ORM\JoinColumn(name="poste_id", referencedColumnName="id" )
     */
    private $poste;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return TypeOpportunite
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TypeOpportunite
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set poste
     *
     * @param \AppBundle\Entity\Poste $poste
     *
     * @return TypeOpportunite
     */
    public function setPoste(\AppBundle\Entity\Poste $poste = null) {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return \AppBundle\Entity\Poste
     */
    public function getPoste() {
        return $this->poste;
    }

}
