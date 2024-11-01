<?php

namespace App\Entity;

use App\Repository\DetailInscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailInscriptionRepository::class)]
class DetailInscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?float $soustotal = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tarif $Tarif = null;

    #[ORM\ManyToOne(targetEntity: Inscription::class)]
    private ?Inscription $inscription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getSoustotal(): ?float
    {
        return $this->soustotal;
    }

    public function setSoustotal(float $soustotal): static
    {
        $this->soustotal = $soustotal;

        return $this;
    }

    public function getTarif(): ?Tarif
    {
        return $this->Tarif;
    }

    public function setTarif(?Tarif $Tarif): static
    {
        $this->Tarif = $Tarif;

        return $this;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(?Inscription $inscription): static
    {
        $this->inscription = $inscription;
        return $this;
    }
}
