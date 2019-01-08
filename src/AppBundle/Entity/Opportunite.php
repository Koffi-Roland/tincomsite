<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Opportunite
 *
 * @ORM\Table(name="opportunite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OpportuniteRepository")
 */
class Opportunite {

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
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLancement", type="datetime")
     */
    private $dateLancement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCloture", type="datetime")
     */
    private $dateCloture;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="TypeOpportunite")
     * @ORM\JoinColumn(name="typeOpportunite_id", referencedColumnName="id")
     */
    private $typeOpportunite;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    private $utilisateur;

    public function upload(UploadedFile $file, $dossier) {
        $fileName = uniqid() . '.' . $file->guessExtension();

        $file->move($dossier, $fileName);
        $this->image = $fileName;

        return $fileName;
    }

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
     * @return Opportunite
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Opportunite
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
     * Set dateLancement
     *
     * @param \DateTime $dateLancement
     *
     * @return Opportunite
     */
    public function setDateLancement($dateLancement) {
        $this->dateLancement = $dateLancement;

        return $this;
    }

    /**
     * Get dateLancement
     *
     * @return \DateTime
     */
    public function getDateLancement() {
        return $this->dateLancement;
    }

    /**
     * Set dateCloture
     *
     * @param \DateTime $dateCloture
     *
     * @return Opportunite
     */
    public function setDateCloture($dateCloture) {
        $this->dateCloture = $dateCloture;

        return $this;
    }

    /**
     * Get dateCloture
     *
     * @return \DateTime
     */
    public function getDateCloture() {
        return $this->dateCloture;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Opportunite
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
     * Set typeOpportunite
     *
     * @param \AppBundle\Entity\TypeOpportunite $typeOpportunite
     *
     * @return Opportunite
     */
    public function setTypeOpportunite(\AppBundle\Entity\TypeOpportunite $typeOpportunite = null) {
        $this->typeOpportunite = $typeOpportunite;

        return $this;
    }

    /**
     * Get typeOpportunite
     *
     * @return \AppBundle\Entity\TypeOpportunite
     */
    public function getTypeOpportunite() {
        return $this->typeOpportunite;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Opportunite
     */
    public function setUtilisateur(\AppBundle\Entity\Utilisateur $utilisateur = null) {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUtilisateur() {
        return $this->utilisateur;
    }


    /**
     * Set image
     *
     * @param string $image
     *
     * @return Opportunite
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Opportunite
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
}
