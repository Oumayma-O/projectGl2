<?php

namespace App\Entity;

use App\Repository\HobbyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HobbyRepository::class)]
class Hobby
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 60)]
    private $désignation;

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
}
