<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MenuRepository")
 */
class Menu {

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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="fils")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;
    
    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="parent", cascade={"remove"})
     */
    private $fils;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Menu
     */
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fils = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Menu
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Menu
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Menu $parent
     *
     * @return Menu
     */
    public function setParent(\AppBundle\Entity\Menu $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Menu
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add fil
     *
     * @param \AppBundle\Entity\Menu $fil
     *
     * @return Menu
     */
    public function addFil(\AppBundle\Entity\Menu $fil)
    {
        $this->fils[] = $fil;

        return $this;
    }

    /**
     * Remove fil
     *
     * @param \AppBundle\Entity\Menu $fil
     */
    public function removeFil(\AppBundle\Entity\Menu $fil)
    {
        $this->fils->removeElement($fil);
    }

    /**
     * Get fils
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFils()
    {
        return $this->fils;
    }
}
