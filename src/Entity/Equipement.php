<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?bool $possede = null;

    #[ORM\ManyToMany(targetEntity: Vehicule::class, inversedBy: 'equipements')]
    private Collection $vehiculeId;

    public function __construct()
    {
        $this->vehiculeId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function isPossede(): ?bool
    {
        return $this->possede;
    }

    public function setPossede(bool $possede): static
    {
        $this->possede = $possede;

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehiculeId(): Collection
    {
        return $this->vehiculeId;
    }

    public function addVehiculeId(Vehicule $vehiculeId): static
    {
        if (!$this->vehiculeId->contains($vehiculeId)) {
            $this->vehiculeId->add($vehiculeId);
        }

        return $this;
    }

    public function removeVehiculeId(Vehicule $vehiculeId): static
    {
        $this->vehiculeId->removeElement($vehiculeId);

        return $this;
    }
}
