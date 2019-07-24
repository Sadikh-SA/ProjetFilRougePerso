<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
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
     * @ORM\Column(type="integer")
     */
    private $codeBanque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numCompte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iban;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bic;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Partenaire", mappedBy="idCompte", cascade={"persist", "remove"})
     */
    private $partenaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SuperAdmin", inversedBy="idCompte")
     */
    private $superAdmin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Caissier", mappedBy="compte")
     */
    private $idcompte;

    public function __construct()
    {
        $this->idcompte = new ArrayCollection();
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

    public function getCodeBanque(): ?int
    {
        return $this->codeBanque;
    }

    public function setCodeBanque(int $codeBanque): self
    {
        $this->codeBanque = $codeBanque;

        return $this;
    }

    public function getNumCompte(): ?string
    {
        return $this->numCompte;
    }

    public function setNumCompte(string $numCompte): self
    {
        $this->numCompte = $numCompte;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(string $bic): self
    {
        $this->bic = $bic;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        // set the owning side of the relation if necessary
        if ($this !== $partenaire->getIdCompte()) {
            $partenaire->setIdCompte($this);
        }

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
     * @return Collection|Caissier[]
     */
    public function getIdcompte(): Collection
    {
        return $this->idcompte;
    }

    public function addIdcompte(Caissier $idcompte): self
    {
        if (!$this->idcompte->contains($idcompte)) {
            $this->idcompte[] = $idcompte;
            $idcompte->setCompte($this);
        }

        return $this;
    }

    public function removeIdcompte(Caissier $idcompte): self
    {
        if ($this->idcompte->contains($idcompte)) {
            $this->idcompte->removeElement($idcompte);
            // set the owning side to null (unless already changed)
            if ($idcompte->getCompte() === $this) {
                $idcompte->setCompte(null);
            }
        }

        return $this;
    }
}
