<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 * @ORM\Table(name="types")
 */
class Type
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArtistType", mappedBy="type", orphanRemoval=true)
     */
    private $artistTypes;

    public function __construct()
    {
        $this->artistTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
   
    public function __toString() {
        return $this->type;
    }

    /**
     * @return Collection|ArtistType[]
     */
    public function getArtistTypes(): Collection
    {
        return $this->artistTypes;
    }
   
    /**
     * @return Artist[]
     */
    public function getArtists() 
    {
        $artists = [];
        foreach($this->artistTypes as $artistType) {
            $artists[] = $artistType->getArtist();
        }
        return $artists;
    }

    public function addArtistType(ArtistType $artistType): self
    {
        if (!$this->artistTypes->contains($artistType)) {
            $this->artistTypes[] = $artistType;
            $artistType->setType($this);
        }

        return $this;
    }

    public function removeArtistType(ArtistType $artistType): self
    {
        if ($this->artistTypes->contains($artistType)) {
            $this->artistTypes->removeElement($artistType);
            // set the owning side to null (unless already changed)
            if ($artistType->getType() === $this) {
                $artistType->setType(null);
            }
        }

        return $this;
    }
}