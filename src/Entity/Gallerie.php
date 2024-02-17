<?php

namespace App\Entity;

use App\Repository\GallerieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: GallerieRepository::class)]
class Gallerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'galleries')]
    private ?Vehicule $vehiculeId = null;

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


    public function getVehiculeId(): ?Vehicule
    {
        return $this->vehiculeId;
    }

    public function setVehiculeId(?Vehicule $vehiculeId): static
    {
        $this->vehiculeId = $vehiculeId;

        return $this;
    }
}
