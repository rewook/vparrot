<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column]
    private ?float $kilometrage = null;

    #[ORM\OneToMany(targetEntity: Gallerie::class, mappedBy: 'vehiculeId')]
    private Collection $galleries;

    #[ORM\ManyToMany(targetEntity: Caracteristique::class, mappedBy: 'vehiculeId')]
    private Collection $caracteristiques;

    #[ORM\ManyToMany(targetEntity: Equipement::class, mappedBy: 'vehiculeId')]
    private Collection $equipements;

    public function __construct()
    {
        $this->galleries = new ArrayCollection();
        $this->caracteristiques = new ArrayCollection();
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getKilometrage(): ?float
    {
        return $this->kilometrage;
    }

    public function setKilometrage(float $kilometrage): static
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    /**
     * @return Collection<int, Gallerie>
     */
    public function getGalleries(): Collection
    {
        return $this->galleries;
    }

    public function addGallery(Gallerie $gallery): static
    {
        if (!$this->galleries->contains($gallery)) {
            $this->galleries->add($gallery);
            $gallery->setVehiculeId($this);
        }

        return $this;
    }

    public function removeGallery(Gallerie $gallery): static
    {
        if ($this->galleries->removeElement($gallery)) {
            // set the owning side to null (unless already changed)
            if ($gallery->getVehiculeId() === $this) {
                $gallery->setVehiculeId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Caracteristique>
     */
    public function getCaracteristiques(): Collection
    {
        return $this->caracteristiques;
    }

    public function addCaracteristique(Caracteristique $caracteristique): static
    {
        if (!$this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques->add($caracteristique);
            $caracteristique->addVehiculeId($this);
        }

        return $this;
    }

    public function removeCaracteristique(Caracteristique $caracteristique): static
    {
        if ($this->caracteristiques->removeElement($caracteristique)) {
            $caracteristique->removeVehiculeId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->addVehiculeId($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeVehiculeId($this);
        }

        return $this;
    }
}
