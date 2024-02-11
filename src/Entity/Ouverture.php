<?php

namespace App\Entity;

use App\Repository\OuvertureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OuvertureRepository::class)]
class Ouverture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hdmatin = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hfmatin = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hdapresmidi = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hfapresmidi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): static
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHdmatin(): ?\DateTimeInterface
    {
        return $this->hdmatin;
    }

    public function setHdmatin(?\DateTimeInterface $hdmatin): static
    {
        $this->hdmatin = $hdmatin;

        return $this;
    }

    public function getHfmatin(): ?\DateTimeInterface
    {
        return $this->hfmatin;
    }

    public function setHfmatin(?\DateTimeInterface $hfmatin): static
    {
        $this->hfmatin = $hfmatin;

        return $this;
    }

    public function getHdapresmidi(): ?\DateTimeInterface
    {
        return $this->hdapresmidi;
    }

    public function setHdapresmidi(?\DateTimeInterface $hdapresmidi): static
    {
        $this->hdapresmidi = $hdapresmidi;

        return $this;
    }

    public function getHfapresmidi(): ?\DateTimeInterface
    {
        return $this->hfapresmidi;
    }

    public function setHfapresmidi(?\DateTimeInterface $hfapresmidi): static
    {
        $this->hfapresmidi = $hfapresmidi;

        return $this;
    }
}
