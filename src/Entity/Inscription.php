<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity]
class Inscription implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    private ?string $plainPassword = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateValidation = null;
    

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $Nomadherent = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(type: 'boolean')]
    private bool $estValide = false;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    private ?string $montantTotal = null;


    // Getters et setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    // Implémentation de UserInterface et PasswordAuthenticatedUserInterface

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * Méthode requise par l'interface UserInterface
     * Efface les informations sensibles après utilisation.
     */
    public function eraseCredentials(): void
    {
        // Effacer le mot de passe en clair après son utilisation
        $this->plainPassword = null;
    }

    public function getSalt(): ?string
    {
        return null; // Aucun salt nécessaire avec bcrypt ou sodium
    }

    public function getNomadherent(): ?string
    {
        return $this->Nomadherent;
    }

    public function setNomadherent(string $Nomadherent): static
    {
        $this->Nomadherent = $Nomadherent;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateValidation(): ?DateTimeInterface
    {
        return $this->dateValidation;
    }

    public function setDateValidation(DateTimeInterface $dateValidation): self
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    public function getestValide(): ?bool
    {
        return $this->estValide;
    }

    public function setestValide(string $estValide): self
    {
        $this->estValide = $estValide;

        return $this;
    }

    public function getMontantTotal(): ?float
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(string $montantTotal): self
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

}
