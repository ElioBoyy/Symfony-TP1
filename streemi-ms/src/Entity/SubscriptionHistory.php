<?php

namespace App\Entity;

use App\Repository\SubscriptionHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionHistoryRepository::class)]
class SubscriptionHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $endDate = null;

    #[ORM\OneToOne(inversedBy: 'subscriptionHistory', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $userId = null;

    #[ORM\OneToOne(inversedBy: 'subscriptionHistory', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subscription $subscriptionId = null;

    #[ORM\ManyToOne(inversedBy: 'userSubscriptionHistory')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeImmutable $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeImmutable $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->userId;
    }

    public function setUserId(?user $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getSubscriptionId(): ?Subscription
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionId(Subscription $subscriptionId): static
    {
        $this->subscriptionId = $subscriptionId;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
