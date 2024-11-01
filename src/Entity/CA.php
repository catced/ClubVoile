<?php

namespace App\Entity;

use App\Repository\CARepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: CARepository::class)]
class CA
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $chemin = null;  // Chemin du fichier

    #[Vich\UploadableField(mapping: 'ca', fileNameProperty: 'chemin')]
    private ?File $file = null;  // Fichier uploadé (PDF, ZIP, etc.)

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $size = null;  // Taille du fichier

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFile(?File $file): void
    {
        $this->file = $file;

        if ($file !== null) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function getChemin(): ?string
    {
        return $this->chemin;
    }

    public function setChemin(?string $chemin): self
    {
        $this->chemin = $chemin;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }
    
    public function getUpdatedUp(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function __toString():string
    {
        return $this->updatedAt ? $this->updatedAt->format('d/m/Y') : 'Pas de date disponible';// Retournez la propriété que vous voulez afficher (par exemple le nom du bateau)
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
