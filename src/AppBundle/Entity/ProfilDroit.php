<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfilDroit
 *
 * @ORM\Table(name="profil_droit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfilDroitRepository")
 */
class ProfilDroit {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Droit", inversedBy="profilDroits")
     * @ORM\JoinColumn(name="droit_id", referencedColumnName="id")
     */
    private $droit;

    /**
     * @ORM\ManyToOne(targetEntity="Profil", inversedBy="profilDroits")
     * @ORM\JoinColumn(name="profil_id", referencedColumnName="id")
     */
    private $profil;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set droit
     *
     * @param \AppBundle\Entity\Droit $droit
     *
     * @return ProfilDroit
     */
    public function setDroit(\AppBundle\Entity\Droit $droit = null)
    {
        $this->droit = $droit;

        return $this;
    }

    /**
     * Get droit
     *
     * @return \AppBundle\Entity\Droit
     */
    public function getDroit()
    {
        return $this->droit;
    }

    /**
     * Set profil
     *
     * @param \AppBundle\Entity\Profil $profil
     *
     * @return ProfilDroit
     */
    public function setProfil(\AppBundle\Entity\Profil $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \AppBundle\Entity\Profil
     */
    public function getProfil()
    {
        return $this->profil;
    }
}
