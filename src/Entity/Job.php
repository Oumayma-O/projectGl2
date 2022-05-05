<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $désignation;

    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'jobs')]
    private $personne;

    public function __construct()
    {
        $this->personne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDésignation(): ?string
    {
        return $this->désignation;
    }

    public function setDésignation(string $désignation): self
    {
        $this->désignation = $désignation;

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonne(): Collection
    {
        return $this->personne;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personne->contains($personne)) {
            $this->personne[] = $personne;
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        $this->personne->removeElement($personne);

        return $this;
    }

    public function __toString(): string
    {
        return $this->getDésignation();
    }


}
