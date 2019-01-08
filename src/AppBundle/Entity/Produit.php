<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit {

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
     * @ORM\Column(name="libelle", type="string", length=255, unique = true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=255, nullable = true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var float
     *
     * @ORM\Column(name="prixGaz", type="float", nullable = true)
     */
    private $prixGaz;

    /**
     * @var float
     *
     * @ORM\Column(name="prixProduit", type="float")
     */
    private $prixProduit;

    /**
     * @ORM\ManyToOne(targetEntity="CategorieProduit")
     * @ORM\JoinColumn(name="categorieProduit_id", referencedColumnName="id")
     */
    private $categorieProduit;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produit
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
     * @return Produit
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
     * Set image
     *
     * @param string $image
     *
     * @return Produit
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

    /**
     * Set prixGaz
     *
     * @param float $prixGaz
     *
     * @return Produit
     */
    public function setPrixGaz($prixGaz) {
        $this->prixGaz = $prixGaz;

        return $this;
    }

    /**
     * Get prixGaz
     *
     * @return float
     */
    public function getPrixGaz() {
        return $this->prixGaz;
    }

    /**
     * Set prixProduit
     *
     * @param float $prixProduit
     *
     * @return Produit
     */
    public function setPrixProduit($prixProduit) {
        $this->prixProduit = $prixProduit;

        return $this;
    }

    /**
     * Get prixProduit
     *
     * @return float
     */
    public function getPrixProduit() {
        return $this->prixProduit;
    }

    /**
     * Set categorieProduit
     *
     * @param \AppBundle\Entity\CategorieProduit $categorieProduit
     *
     * @return Produit
     */
    public function setCategorieProduit(\AppBundle\Entity\CategorieProduit $categorieProduit = null) {
        $this->categorieProduit = $categorieProduit;

        return $this;
    }

    /**
     * Get categorieProduit
     *
     * @return \AppBundle\Entity\CategorieProduit
     */
    public function getCategorieProduit() {
        return $this->categorieProduit;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Produit
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

}
