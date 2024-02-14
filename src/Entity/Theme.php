<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $publishedAt = null;

    #[ORM\OneToMany(targetEntity: Shot::class, mappedBy: 'subject', orphanRemoval: true)]
    private Collection $shots;

    public function __construct()
    {
        $this->shots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): static
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return Collection<int, Shot>
     */
    public function getShots(): Collection
    {
        return $this->shots;
    }

    public function addShot(Shot $shot): static
    {
        if (!$this->shots->contains($shot)) {
            $this->shots->add($shot);
            $shot->setSubject($this);
        }

        return $this;
    }

    public function removeShot(Shot $shot): static
    {
        if ($this->shots->removeElement($shot)) {
            // set the owning side to null (unless already changed)
            if ($shot->getSubject() === $this) {
                $shot->setSubject(null);
            }
        }

        return $this;
    }
}
