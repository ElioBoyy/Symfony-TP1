<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Season>
     */
    #[ORM\OneToMany(targetEntity: Season::class, mappedBy: 'serie')]
    private Collection $serieSeasons;

    public function __construct()
    {
        $this->serieSeasons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Season>
     */
    public function getSerieSeasons(): Collection
    {
        return $this->serieSeasons;
    }

    public function addSerieSeason(Season $serieSeason): static
    {
        if (!$this->serieSeasons->contains($serieSeason)) {
            $this->serieSeasons->add($serieSeason);
            $serieSeason->setSerie($this);
        }

        return $this;
    }

    public function removeSerieSeason(Season $serieSeason): static
    {
        if ($this->serieSeasons->removeElement($serieSeason)) {
            // set the owning side to null (unless already changed)
            if ($serieSeason->getSerie() === $this) {
                $serieSeason->setSerie(null);
            }
        }

        return $this;
    }
}
