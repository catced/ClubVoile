<?php

namespace App\Entity;

use App\Repository\BateauTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BateauTypeRepository::class)]
class BateauType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $bateautype;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBateauType(): ?string
    {
        return $this->bateautype;
    }

    public function setBateauType(string $bateautype): self
    {
        $this->bateautype = $bateautype;

        return $this;
    }

    public function __toString(): string
    {
        return $this->bateautype; // Retournez la propriété que vous voulez afficher (par exemple le nom du bateau)
    }
}
