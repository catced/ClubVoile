<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Bateau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagePath;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $longueur = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $largeur = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $tirant_eau = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $SurfGV = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $Genois = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $Spi = null;

    #[ORM\ManyToOne(targetEntity: BateauType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?bateautype $bateautype = null;

    

    

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getLongueur(): ?string
    {
        return $this->longueur;
    }

    public function setLongueur(string $longueur): static
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?string
    {
        return $this->largeur;
    }

    public function setLargeur(string $largeur): static
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getTirantEau(): ?string
    {
        return $this->tirant_eau;
    }

    public function setTirantEau(string $tirant_eau): static
    {
        $this->tirant_eau = $tirant_eau;

        return $this;
    }

    public function getSurfGV(): ?string
    {
        return $this->SurfGV;
    }

    public function setSurfGV(string $SurfGV): static
    {
        $this->SurfGV = $SurfGV;

        return $this;
    }

    public function getGenois(): ?string
    {
        return $this->Genois;
    }

    public function setGenois(string $Genois): static
    {
        $this->Genois = $Genois;

        return $this;
    }

    public function getSpi(): ?string
    {
        return $this->Spi;
    }

    public function setSpi(string $Spi): static
    {
        $this->Spi = $Spi;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom; // Retournez la propriété que vous voulez afficher (par exemple le nom du bateau)
    }

    public function getBateauType(): ?BateauType
    {
        return $this->bateautype;
    }

    public function setBateauType(?BateauType $bateautype): self
    {
        $this->bateautype = $bateautype;
        return $this;
    }

  
}
