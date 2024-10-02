<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $label = null;

    // /**
    //  * @var Collection<int, CategorieMedia>
    //  */
    // #[ORM\OneToMany(targetEntity: CategorieMedia::class, mappedBy: 'categorie')]
    // private Collection $categorieMedias;

    // public function __construct()
    // {
    //     $this->categorieMedias = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    // /**
    //  * @return Collection<int, CategorieMedia>
    //  */
    // public function getCategorieMedias(): Collection
    // {
    //     return $this->categorieMedias;
    // }

    // public function addCategorieMedia(CategorieMedia $categorieMedia): static
    // {
    //     if (!$this->categorieMedias->contains($categorieMedia)) {
    //         $this->categorieMedias->add($categorieMedia);
    //         $categorieMedia->setCategorie($this);
    //     }

    //     return $this;
    // }

    // public function removeCategorieMedia(CategorieMedia $categorieMedia): static
    // {
    //     if ($this->categorieMedias->removeElement($categorieMedia)) {
    //         // set the owning side to null (unless already changed)
    //         if ($categorieMedia->getCategorie() === $this) {
    //             $categorieMedia->setCategorie(null);
    //         }
    //     }

    //     return $this;
    // }
    
}
