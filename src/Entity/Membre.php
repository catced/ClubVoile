<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Entity\MembreRepository;
// use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Membre implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $nom;

    #[ORM\Column(type: 'string', length: 100)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $telephone;

    #[ORM\Column(type: 'boolean')]
    private $actif;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    private ?string $plainPassword = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    private ?string $montantTotal = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    // #[ORM\OneToMany(mappedBy: 'membre', targetEntity: Planning::class)]
    // private Collection $plannings;

    #[ORM\ManyToMany(targetEntity: Planning::class, mappedBy: "participants")]
    private $plannings;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }
    public function getActif(): ?Bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
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

    public function getUsername(): string
    {
        return $this->email;
    }
	 
	 public function getUserIdentifier(): string
    {
        return $this->email; // ou un autre identifiant unique
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getMontantTotal(): ?float
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(?float $montantTotal): self
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function __construct()
    {
        $this->plannings = new ArrayCollection();
    }

    /**
     * @return Collection<int, Planning>
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    // public function addPlanning(Planning $planning): self
    // {
    //     if (!$this->plannings->contains($planning)) {
    //         $this->plannings[] = $planning;
    //         $planning->setMembre($this);
    //     }

    //     return $this;
    // }

    // public function removePlanning(Planning $planning): self
    // {
    //     if ($this->plannings->removeElement($planning)) {
    //         // set the owning side to null (unless already changed)
    //         if ($planning->getMembre() === $this) {
    //             $planning->setMembre(null);
    //         }
    //     }

    //     return $this;
    // }

    public function eraseCredentials(): void
    {
        // Si tu stockes des informations sensibles en clair (comme un mot de passe temporaire),
        // tu devrais les effacer ici. Sinon, laisse cette méthode vide.
    }


    public function addPlanning(Planning $planning): self
        {
            if (!$this->plannings->contains($planning)) {
                $this->plannings[] = $planning;
                $planning->addParticipant($this);
            }

            return $this;
        }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->removeElement($planning)) {
            $planning->removeParticipant($this);
        }

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }
}