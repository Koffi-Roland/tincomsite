<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Actualite
 *
 * @ORM\Table(name="actualite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActualiteRepository")
 */
class Actualite {

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
     * @ORM\Column(name="titre", type="string", unique = true)
     */
    private $titre;
    
    /**
     * @Gedmo\Slug(fields={"titre"}, updatable=true)
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;
    
    /**
     * @var string
     *
     * @ORM\Column(name="surTitre", type="string", length=255)
     */
    private $surTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="extrait", type="text", nullable = true)
     */
    private $extrait;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable = true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="CategorieActualite", inversedBy="actualites")
     * @ORM\JoinColumn(name="categorieActualite_id", referencedColumnName="id")
     */
    private $categorieActualite;
    
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Actualite
     */
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Set surTitre
     *
     * @param string $surTitre
     *
     * @return Actualite
     */
    public function setSurTitre($surTitre) {
        $this->surTitre = $surTitre;

        return $this;
    }

    /**
     * Get surTitre
     *
     * @return string
     */
    public function getSurTitre() {
        return $this->surTitre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Actualite
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Actualite
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorieActualite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Actualite
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add categorieActualite
     *
     * @param \AppBundle\Entity\CategorieActualite $categorieActualite
     *
     * @return Actualite
     */
    public function addCategorieActualite(\AppBundle\Entity\CategorieActualite $categorieActualite)
    {
        $this->categorieActualite[] = $categorieActualite;

        return $this;
    }

    /**
     * Remove categorieActualite
     *
     * @param \AppBundle\Entity\CategorieActualite $categorieActualite
     */
    public function removeCategorieActualite(\AppBundle\Entity\CategorieActualite $categorieActualite)
    {
        $this->categorieActualite->removeElement($categorieActualite);
    }

    /**
     * Get categorieActualite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorieActualite()
    {
        return $this->categorieActualite;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Actualite
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

    /**
     * Set extrait
     *
     * @param string $extrait
     *
     * @return Actualite
     */
    public function setExtrait($extrait)
    {
        $this->extrait = $extrait;

        return $this;
    }

    /**
     * Get extrait
     *
     * @return string
     */
    public function getExtrait()
    {
        return $this->extrait;
    }

    /**
     * Set categorieActualite
     *
     * @param \AppBundle\Entity\CategorieActualite $categorieActualite
     *
     * @return Actualite
     */
    public function setCategorieActualite(\AppBundle\Entity\CategorieActualite $categorieActualite = null)
    {
        $this->categorieActualite = $categorieActualite;

        return $this;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Actualite
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
