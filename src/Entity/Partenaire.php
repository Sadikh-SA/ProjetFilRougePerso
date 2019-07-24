<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
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
    private $regCom;

    /**
     * @ORM\Column(type="float")
     */
    private $ninea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domaine;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Compte", inversedBy="partenaire", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCompte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SuperAdmin", inversedBy="idPartenaire")
     */
    private $superAdmin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdminPartenaire", mappedBy="idPart")
     */
    private $adminPartenaires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil", inversedBy="partenaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProfil;

    public function __construct()
    {
        $this->adminPartenaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegCom(): ?string
    {
        return $this->regCom;
    }

    public function setRegCom(string $regCom): self
    {
        $this->regCom = $regCom;

        return $this;
    }

    public function getNinea(): ?float
    {
        return $this->ninea;
    }

    public function setNinea(float $ninea): self
    {
        $this->ninea = $ninea;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    public function getIdCompte(): ?Compte
    {
        return $this->idCompte;
    }

    public function setIdCompte(Compte $idCompte): self
    {
        $this->idCompte = $idCompte;

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

    /**
     * @return Collection|AdminPartenaire[]
     */
    public function getAdminPartenaires(): Collection
    {
        return $this->adminPartenaires;
    }

    public function addAdminPartenaire(AdminPartenaire $adminPartenaire): self
    {
        if (!$this->adminPartenaires->contains($adminPartenaire)) {
            $this->adminPartenaires[] = $adminPartenaire;
            $adminPartenaire->setIdPart($this);
        }

        return $this;
    }

    public function removeAdminPartenaire(AdminPartenaire $adminPartenaire): self
    {
        if ($this->adminPartenaires->contains($adminPartenaire)) {
            $this->adminPartenaires->removeElement($adminPartenaire);
            // set the owning side to null (unless already changed)
            if ($adminPartenaire->getIdPart() === $this) {
                $adminPartenaire->setIdPart(null);
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
