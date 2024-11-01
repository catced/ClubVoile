<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    // #[ORM\Column(type: "json")] // Utilisez json pour stocker un tableau
    // #[Assert\Callback([self::class, 'validateTypeJournee'])]
    // private array $typeJournee = [];

    #[ORM\ManyToOne(targetEntity: BateauType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?BateauType $bateautype = null;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(nullable: true)]
    private $admin;

   
  #[ORM\ManyToMany(targetEntity: Membre::class)]
    #[ORM\JoinTable(
        name: "planning_membre",
        joinColumns: [new ORM\JoinColumn(name: "planning_id", referencedColumnName: "id")],
        inverseJoinColumns: [new ORM\JoinColumn(name: "membre_id", referencedColumnName: "id")]
    )]

    private Collection $participants;


    #[ORM\Column(type: 'string', length: 20)]
    private ?string $typeJournee = null; // "matin", "apres_midi", "journee"
    // #[ORM\ManyToMany(targetEntity: Membre::class)]
    // #[ORM\JoinTable(
    //     name: "planning_membre",
    //     joinColumns: [new ORM\JoinColumn(name: "planning_id", referencedColumnName: "id")],
    //     inverseJoinColumns: [new ORM\JoinColumn(name: "membre_id", referencedColumnName: "id")]
    // )]
    
//    private Collection $participants;
  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }
    
    // #[ORM\ManyToMany(targetEntity: Membre::class)]
    // #[ORM\JoinTable(
    //     name: "planning_membre",
    //     joinColumns: [new ORM\JoinColumn(name: "planning_id", referencedColumnName: "id")],
    //     inverseJoinColumns: [new ORM\JoinColumn(name: "membre_id", referencedColumnName: "id")]
    // )]
    // private $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

   
   

    // Ajout de la validation personnalisée pour les cases à cocher
    // public static function validateTypeJournee($object, \Symfony\Component\Validator\Context\ExecutionContextInterface $context)
    // {
    //     if (!is_object($object)) {
    //         return; // Vérifiez d'abord que $object est bien une instance de l'entité
    //     }
    
    //     $typeJournee = $object->getTypeJournee();
    
    //     // Vérification que 'typeJournee' est bien un tableau avant de continuer
    //     if (is_array($typeJournee)) {
    //         if (in_array('journee', $typeJournee) && (in_array('matin', $typeJournee) || in_array('apres_midi', $typeJournee))) {
    //             $context->buildViolation('Vous ne pouvez pas cocher à la fois Matin/Après-midi et Journée complète.')
    //                 ->atPath('typeJournee')
    //                 ->addViolation();
    //            }   }
    // }
  


    public function getTypeJournee(): ?string
    {
        return $this->typeJournee;
    }

    public function setTypeJournee(?string $typeJournee): self
    {
        $this->typeJournee = $typeJournee;
        return $this;
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

    /**
     * @return Collection|Membre[]
     */
  
    public function getParticipants(): Collection
    {
        return $this->participants;
    }
  
    
    public function addParticipant(Membre $membre): self
    {
        if (!$this->participants->contains($membre)) {
            $this->participants[] = $membre;
        }

        return $this;
    }

    public function removeParticipant(Membre $membre): self
    {
        $this->participants->removeElement($membre);

        return $this;
    }

    public function getAdmin(): ?Utilisateur
    {
        return $this->admin;
    }

    public function setAdmin(?Utilisateur $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

     
   
}
