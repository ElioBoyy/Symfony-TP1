<?php

namespace App\Entity;

use App\Repository\MediaLanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaLanguageRepository::class)]
class MediaLanguage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\ManyToMany(targetEntity: Media::class, mappedBy: 'mediaLanguages')]
    private Collection $media;

    #[ORM\ManyToOne(inversedBy: 'mediaLanguages')]
    private ?Language $language = null;

    public function __construct()
    {
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): static
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->addMediaLanguage($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): static
    {
        if ($this->media->removeElement($medium)) {
            $medium->removeMediaLanguage($this);
        }

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): static
    {
        $this->language = $language;

        return $this;
    }
}
