<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AdminPartenaireRepository")
 */
class AdminPartenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SuperAdmin", inversedBy="idAdminPart")
     */
    private $superAdmin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProfil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Caissier", mappedBy="idAdminPart")
     */
    private $caissiers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="adminPartenaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPart;

    public function __construct()
    {
        $this->caissiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSuperAdmin(): ?SuperAdmin
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(?SuperAdmin $superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }

    public function getIdProfil(): ?Profil
    {
        return $this->idProfil;
    }

    public function setIdProfil(?Profil $idProfil): self
    {
        $this->idProfil = $idProfil;

        return $this;
    }

    /**
     * @return Collection|Caissier[]
     */
    public function getCaissiers(): Collection
    {
        return $this->caissiers;
    }

    public function addCaissier(Caissier $caissier): self
    {
        if (!$this->caissiers->contains($caissier)) {
            $this->caissiers[] = $caissier;
            $caissier->setIdAdminPart($this);
        }

        return $this;
    }

    public function removeCaissier(Caissier $caissier): self
    {
        if ($this->caissiers->contains($caissier)) {
            $this->caissiers->removeElement($caissier);
            // set the owning side to null (unless already changed)
            if ($caissier->getIdAdminPart() === $this) {
                $caissier->setIdAdminPart(null);
            }
        }

        return $this;
    }

    public function getIdPart(): ?Partenaire
    {
        return $this->idPart;
    }

    public function setIdPart(?Partenaire $idPart): self
    {
        $this->idPart = $idPart;

        return $this;
    }

}
