<?php

namespace App\Traits;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
trait TimeStampTrait
{

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatesAt;

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatesAt(): ?\DateTimeInterface
    {
        return $this->updatesAt;
    }

    public function setUpdatesAt(?\DateTimeInterface $updatesAt): self
    {
        $this->updatesAt = $updatesAt;

        return $this;
    }

    #[ORM\PrePersist()]
    public function onPrePersist(){
        $this->createdAt=new \DateTime();
        $this->updatesAt=new \DateTime();
    }

    #[ORM\PreUpdate()]
    public function onPreUpdate(){
        $this->updatesAt=new \DateTime();
    }


}