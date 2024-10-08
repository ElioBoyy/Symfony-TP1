<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $durationInMonths = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'subscriptions')]
    private Collection $users;

    #[ORM\OneToOne(mappedBy: 'subscriptionId', cascade: ['persist', 'remove'])]
    private ?SubscriptionHistory $subscriptionHistory = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @var Collection<int, User>
     */

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDurationInMonths(): ?int
    {
        return $this->durationInMonths;
    }

    public function setDurationInMonths(int $durationInMonths): static
    {
        $this->durationInMonths = $durationInMonths;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    public function getSubscriptionHistory(): ?SubscriptionHistory
    {
        return $this->subscriptionHistory;
    }

    public function setSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        // set the owning side of the relation if necessary
        if ($subscriptionHistory->getSubscriptionId() !== $this) {
            $subscriptionHistory->setSubscriptionId($this);
        }

        $this->subscriptionHistory = $subscriptionHistory;

        return $this;
    }
}
