<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * SousTypeDistributeur
 *
 * @ORM\Table(name="sous_type_distributeur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SousTypeDistributeurRepository")
 */
class SousTypeDistributeur {

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
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="TypeDistributeur")
     * @ORM\JoinColumn(name="typeDistributeur_id", referencedColumnName="id")
     */
    private $typeDistributeur;

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
     * @return SousTypeDistributeur
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
     * Set typeDistributeur
     *
     * @param \AppBundle\Entity\TypeDistributeur $typeDistributeur
     *
     * @return SousTypeDistributeur
     */
    public function setTypeDistributeur(\AppBundle\Entity\TypeDistributeur $typeDistributeur = null)
    {
        $this->typeDistributeur = $typeDistributeur;

        return $this;
    }

    /**
     * Get typeDistributeur
     *
     * @return \AppBundle\Entity\TypeDistributeur
     */
    public function getTypeDistributeur()
    {
        return $this->typeDistributeur;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SousTypeDistributeur
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
}
