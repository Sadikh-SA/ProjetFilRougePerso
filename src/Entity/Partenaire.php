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
     * @ORM\Column(type="float", unique=true)
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
     * @ORM\OneToMany(targetEntity="App\Entity\Utilisateur", mappedBy="idParte")
     */
    private $utilisateurs;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Compte", inversedBy="partenaire", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCompte;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="idPartenaire")
     */
    private $depots;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->depots = new ArrayCollection();
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

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setIdParte($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->removeElement($utilisateur);
            // set the owning side to null (unless already changed)
            if ($utilisateur->getIdParte() === $this) {
                $utilisateur->setIdParte(null);
            }
        }

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

    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
            $depot->setIdPartenaire($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getIdPartenaire() === $this) {
                $depot->setIdPartenaire(null);
            }
        }

        return $this;
    }
}
