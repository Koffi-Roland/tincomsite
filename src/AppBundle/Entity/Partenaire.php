<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Partenaire
 *
 * @ORM\Table(name="partenaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartenaireRepository")
 */
class Partenaire {

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
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="text")
     */
    private $lien;

    /**
     * @ORM\ManyToOne(targetEntity="CategoriePartenaire")
     * @ORM\JoinColumn(name="categoriePartenaire_id", referencedColumnName="id")
     */
    private $categoriePartenaire;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Partenaire
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
     * Set lien
     *
     * @param string $lien
     *
     * @return Partenaire
     */
    public function setLien($lien) {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien() {
        return $this->lien;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Partenaire
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
     * Set categoriePartenaire
     *
     * @param \AppBundle\Entity\CategoriePartenaire $categoriePartenaire
     *
     * @return Partenaire
     */
    public function setCategoriePartenaire(\AppBundle\Entity\CategoriePartenaire $categoriePartenaire = null) {
        $this->categoriePartenaire = $categoriePartenaire;

        return $this;
    }

    /**
     * Get categoriePartenaire
     *
     * @return \AppBundle\Entity\CategoriePartenaire
     */
    public function getCategoriePartenaire() {
        return $this->categoriePartenaire;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Partenaire
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

}
