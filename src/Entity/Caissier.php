<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CaissierRepository")
 */
class Caissier
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
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProfil;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdminPartenaire", inversedBy="caissiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAdminPart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="idcompte")
     */
    private $compte;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getIdAdminPart(): ?AdminPartenaire
    {
        return $this->idAdminPart;
    }

    public function setIdAdminPart(?AdminPartenaire $idAdminPart): self
    {
        $this->idAdminPart = $idAdminPart;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }
}
