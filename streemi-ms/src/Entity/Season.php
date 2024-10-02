<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $seasonNumber = null;

    #[ORM\ManyToOne(inversedBy: 'serieSeasons')]
    private ?Serie $serie = null;

    /**
     * @var Collection<int, Episode>
     */
    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: 'season')]
    private Collection $seasonEpisodes;

    public function __construct()
    {
        $this->seasonEpisodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonNumber(): ?int
    {
        return $this->seasonNumber;
    }

    public function setSeasonNumber(int $seasonNumber): static
    {
        $this->seasonNumber = $seasonNumber;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getSeasonEpisodes(): Collection
    {
        return $this->seasonEpisodes;
    }

    public function addSeasonEpisode(Episode $seasonEpisode): static
    {
        if (!$this->seasonEpisodes->contains($seasonEpisode)) {
            $this->seasonEpisodes->add($seasonEpisode);
            $seasonEpisode->setSeason($this);
        }

        return $this;
    }

    public function removeSeasonEpisode(Episode $seasonEpisode): static
    {
        if ($this->seasonEpisodes->removeElement($seasonEpisode)) {
            // set the owning side to null (unless already changed)
            if ($seasonEpisode->getSeason() === $this) {
                $seasonEpisode->setSeason(null);
            }
        }

        return $this;
    }
}
