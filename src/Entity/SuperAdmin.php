<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SuperAdminRepository")
 */
class SuperAdmin
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
     * @ORM\OneToMany(targetEntity="App\Entity\Compte", mappedBy="superAdmin")
     */
    private $idCompte;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partenaire", mappedBy="superAdmin")
     */
    private $idPartenaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdminPartenaire", mappedBy="superAdmin")
     */
    private $idAdminPart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProfil;

    public function __construct()
    {
        $this->idCompte = new ArrayCollection();
        $this->idPartenaire = new ArrayCollection();
        $this->idAdminPart = new ArrayCollection();
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

    /**
     * @return Collection|Compte[]
     */
    public function getIdCompte(): Collection
    {
        return $this->idCompte;
    }

    public function addIdCompte(Compte $idCompte): self
    {
        if (!$this->idCompte->contains($idCompte)) {
            $this->idCompte[] = $idCompte;
            $idCompte->setSuperAdmin($this);
        }

        return $this;
    }

    public function removeIdCompte(Compte $idCompte): self
    {
        if ($this->idCompte->contains($idCompte)) {
            $this->idCompte->removeElement($idCompte);
            // set the owning side to null (unless already changed)
            if ($idCompte->getSuperAdmin() === $this) {
                $idCompte->setSuperAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Partenaire[]
     */
    public function getIdPartenaire(): Collection
    {
        return $this->idPartenaire;
    }

    public function addIdPartenaire(Partenaire $idPartenaire): self
    {
        if (!$this->idPartenaire->contains($idPartenaire)) {
            $this->idPartenaire[] = $idPartenaire;
            $idPartenaire->setSuperAdmin($this);
        }

        return $this;
    }

    public function removeIdPartenaire(Partenaire $idPartenaire): self
    {
        if ($this->idPartenaire->contains($idPartenaire)) {
            $this->idPartenaire->removeElement($idPartenaire);
            // set the owning side to null (unless already changed)
            if ($idPartenaire->getSuperAdmin() === $this) {
                $idPartenaire->setSuperAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AdminPartenaire[]
     */
    public function getIdAdminPart(): Collection
    {
        return $this->idAdminPart;
    }

    public function addIdAdminPart(AdminPartenaire $idAdminPart): self
    {
        if (!$this->idAdminPart->contains($idAdminPart)) {
            $this->idAdminPart[] = $idAdminPart;
            $idAdminPart->setSuperAdmin($this);
        }

        return $this;
    }

    public function removeIdAdminPart(AdminPartenaire $idAdminPart): self
    {
        if ($this->idAdminPart->contains($idAdminPart)) {
            $this->idAdminPart->removeElement($idAdminPart);
            // set the owning side to null (unless already changed)
            if ($idAdminPart->getSuperAdmin() === $this) {
                $idAdminPart->setSuperAdmin(null);
            }
        }

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
}
