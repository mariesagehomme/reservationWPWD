<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 * @ORM\Table(name="artists")
 */
class Artist
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $lastname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArtistType", mappedBy="artist", orphanRemoval=true)
     */
    private $artistTypes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Agent", inversedBy="artists")
     */
    private $agent;
    

    public function __construct()
    {
        $this->artistTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
    
    public function __toString() {
        return $this->firstname." ".$this->lastname;
    }

    /**
     * @return Collection|ArtistType[]
     */
    public function getArtistTypes(): Collection
    {
        return $this->artistTypes;
    }

    public function addArtistType(ArtistType $artistType): self
    {
        if (!$this->artistTypes->contains($artistType)) {
            $this->artistTypes[] = $artistType;
            $artistType->setArtist($this);
        }

        return $this;
    }

    public function removeArtistType(ArtistType $artistType): self
    {
        if ($this->artistTypes->contains($artistType)) {
            $this->artistTypes->removeElement($artistType);
            // set the owning side to null (unless already changed)
            if ($artistType->getArtist() === $this) {
                $artistType->setArtist(null);
            }
        }

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;

        return $this;
    }
}