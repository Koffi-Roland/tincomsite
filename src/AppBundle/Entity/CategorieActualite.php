<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieActualite
 *
 * @ORM\Table(name="categorie_actualite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieActualiteRepository")
 */
class CategorieActualite {

    /**
     * @var int
     *s
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255,unique=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable = true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Actualite", mappedBy="categorieActualite")
     */
    private $actualite;
    
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
     * @return CategorieActualite
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
     * @return CategorieActualite
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
     * Constructor
     */
    public function __construct()
    {
        $this->actualite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actualite
     *
     * @param \AppBundle\Entity\Actualite $actualite
     *
     * @return CategorieActualite
     */
    public function addActualite(\AppBundle\Entity\Actualite $actualite)
    {
        $this->actualite[] = $actualite;

        return $this;
    }

    /**
     * Remove actualite
     *
     * @param \AppBundle\Entity\Actualite $actualite
     */
    public function removeActualite(\AppBundle\Entity\Actualite $actualite)
    {
        $this->actualite->removeElement($actualite);
    }

    /**
     * Get actualite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActualite()
    {
        return $this->actualite;
    }
}
