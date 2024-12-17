<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

#[Entity(repositoryClass: SerieRepository::class)]
class Serie extends Media
{
    /**
     * @var Collection<int, Season>
     */
    #[ORM\OneToMany(targetEntity: Season::class, mappedBy: 'serie')]
    private Collection $seasons;

    #[ORM\Column(type: 'string', length: 255)]
    private string $genre;

    private $creator;

    public function __construct()
    {
        parent::__construct();
        $this->seasons = new ArrayCollection();
    }

    /**
     * @return Collection<int, Season>
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(Season $season): static
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons->add($season);
            $season->setSerie($this);
        }

        return $this;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;
        return $this;
    }

    public function getCreator()
    {
        return $this->creator;
    }

    public function setCreator($creator): self
    {
        $this->creator = $creator;
        return $this;
    }

    public function removeSeason(Season $season): static
    {
        if ($this->seasons->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getSerie() === $this) {
                $season->setSerie(null);
            }
        }

        return $this;
    }
}
