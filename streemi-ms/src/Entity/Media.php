<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $longDescription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column(length: 255)]
    private ?string $coverImage = null;

    #[ORM\Column]
    private array $staff = [];

    #[ORM\Column]
    private array $cast = [];

    /**
     * @var Collection<int, PlaylistMedia>
     */
    #[ORM\OneToMany(targetEntity: PlaylistMedia::class, mappedBy: 'media')]
    private Collection $playlistMedia;

    /**
     * @var Collection<int, WatchHistoty>
     */
    #[ORM\OneToMany(targetEntity: WatchHistoty::class, mappedBy: 'media')]
    private Collection $watchHistory;

    /**
     * @var Collection<int, Comments>
     */
    #[ORM\OneToMany(targetEntity: Comments::class, mappedBy: 'media')]
    private Collection $mediaComments;

    // /**
    //  * @var Collection<int, CategorieMedia>
    //  */
    // #[ORM\ManyToMany(targetEntity: CategorieMedia::class, inversedBy: 'media')]
    // private Collection $categoryMedias;

    // /**
    //  * @var Collection<int, MediaLanguage>
    //  */
    // #[ORM\ManyToMany(targetEntity: MediaLanguage::class, inversedBy: 'media')]
    // private Collection $mediaLanguages;

    // #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    // private ?Movie $mediaMovie = null;

    // #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    // private ?Serie $mediaSerie = null;

    public function __construct()
    {
        $this->playlistMedia = new ArrayCollection();
        $this->watchHistory = new ArrayCollection();
        $this->mediaComments = new ArrayCollection();
        // $this->categoryMedias = new ArrayCollection();
        // $this->mediaLanguages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(string $longDescription): static
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): static
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function getStaff(): array
    {
        return $this->staff;
    }

    public function setStaff(array $staff): static
    {
        $this->staff = $staff;

        return $this;
    }

    public function getCast(): array
    {
        return $this->cast;
    }

    public function setCast(array $cast): static
    {
        $this->cast = $cast;

        return $this;
    }

    /**
     * @return Collection<int, PlaylistMedia>
     */
    public function getPlaylistMedia(): Collection
    {
        return $this->playlistMedia;
    }

    public function addPlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if (!$this->playlistMedia->contains($playlistMedium)) {
            $this->playlistMedia->add($playlistMedium);
            $playlistMedium->setMedia($this);
        }

        return $this;
    }

    public function removePlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if ($this->playlistMedia->removeElement($playlistMedium)) {
            // set the owning side to null (unless already changed)
            if ($playlistMedium->getMedia() === $this) {
                $playlistMedium->setMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WatchHistoty>
     */
    public function getWatchHistory(): Collection
    {
        return $this->watchHistory;
    }

    public function addWatchHistory(WatchHistoty $watchHistory): static
    {
        if (!$this->watchHistory->contains($watchHistory)) {
            $this->watchHistory->add($watchHistory);
            $watchHistory->setMedia($this);
        }

        return $this;
    }

    public function removeWatchHistory(WatchHistoty $watchHistory): static
    {
        if ($this->watchHistory->removeElement($watchHistory)) {
            // set the owning side to null (unless already changed)
            if ($watchHistory->getMedia() === $this) {
                $watchHistory->setMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getMediaComments(): Collection
    {
        return $this->mediaComments;
    }

    public function addMediaComment(Comments $mediaComment): static
    {
        if (!$this->mediaComments->contains($mediaComment)) {
            $this->mediaComments->add($mediaComment);
            $mediaComment->setMedia($this);
        }

        return $this;
    }

    public function removeMediaComment(Comments $mediaComment): static
    {
        if ($this->mediaComments->removeElement($mediaComment)) {
            // set the owning side to null (unless already changed)
            if ($mediaComment->getMedia() === $this) {
                $mediaComment->setMedia(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection<int, CategorieMedia>
    //  */
    // public function getCategoryMedias(): Collection
    // {
    //     return $this->categoryMedias;
    // }

    // public function addCategoryMedia(CategorieMedia $categoryMedia): static
    // {
    //     if (!$this->categoryMedias->contains($categoryMedia)) {
    //         $this->categoryMedias->add($categoryMedia);
    //     }

    //     return $this;
    // }

    // public function removeCategoryMedia(CategorieMedia $categoryMedia): static
    // {
    //     $this->categoryMedias->removeElement($categoryMedia);

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, MediaLanguage>
    //  */
    // public function getMediaLanguages(): Collection
    // {
    //     return $this->mediaLanguages;
    // }

    // public function addMediaLanguage(MediaLanguage $mediaLanguage): static
    // {
    //     if (!$this->mediaLanguages->contains($mediaLanguage)) {
    //         $this->mediaLanguages->add($mediaLanguage);
    //     }

    //     return $this;
    // }

    // public function removeMediaLanguage(MediaLanguage $mediaLanguage): static
    // {
    //     $this->mediaLanguages->removeElement($mediaLanguage);

    //     return $this;
    // }

    // public function getMediaMovie(): ?Movie
    // {
    //     return $this->mediaMovie;
    // }

    // public function setMediaMovie(?Movie $mediaMovie): static
    // {
    //     $this->mediaMovie = $mediaMovie;

    //     return $this;
    // }

    // public function getMediaSerie(): ?Serie
    // {
    //     return $this->mediaSerie;
    // }

    // public function setMediaSerie(?Serie $mediaSerie): static
    // {
    //     $this->mediaSerie = $mediaSerie;

    //     return $this;
    // }
}
