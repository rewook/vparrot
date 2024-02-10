<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hdmatin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hfmatin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hdapresmidi = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hfapresmidi = null;

    #[ORM\ManyToMany(targetEntity: JourOuvert::class, inversedBy: 'horaires')]
    private Collection $jourid;

    public function __construct()
    {
        $this->jourid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, JourOuvert>
     */
    public function getJourid(): Collection
    {
        return $this->jourid;
    }

    public function addJourid(JourOuvert $jourid): static
    {
        if (!$this->jourid->contains($jourid)) {
            $this->jourid->add($jourid);
        }

        return $this;
    }

    public function removeJourid(JourOuvert $jourid): static
    {
        $this->jourid->removeElement($jourid);

        return $this;
    }
}
