<?php

namespace App\Entity;

enum AccountStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case NONE = 'none';
}

enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';
}

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: false)]
    private ?string $username = null;

    #[ORM\Column(length: 255, unique: false)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $password = null;

    #[ORM\Column(type: 'string', enumType: AccountStatus::class)]
    private AccountStatus $accountStatus = AccountStatus::NONE;

    #[ORM\Column(type: 'string', enumType: Role::class)]
    private Role $accountRole = Role::USER;

    /**
     * @var Collection<int, Subscription>
     */
    #[ORM\ManyToMany(targetEntity: Subscription::class, mappedBy: 'users')]
    private Collection $subscriptions;

    #[ORM\OneToOne(mappedBy: 'userId', cascade: ['persist', 'remove'])]
    private ?SubscriptionHistory $subscriptionHistory = null;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'user')]
    private Collection $userPlaylists;

    /**
     * @var Collection<int, Comments>
     */
    #[ORM\OneToMany(targetEntity: Comments::class, mappedBy: 'user')]
    private Collection $userComments;

    /**
     * @var Collection<int, WatchHistoty>
     */
    #[ORM\OneToMany(targetEntity: WatchHistoty::class, mappedBy: 'user')]
    private Collection $userWatchHistory;

    /**
     * @var Collection<int, SubscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'user')]
    private Collection $userSubscriptionHistory;

    /**
     * @var Collection<int, PlaylistSubscription>
     */
    #[ORM\OneToMany(targetEntity: PlaylistSubscription::class, mappedBy: 'userPlaylist')]
    private Collection $playlistSubscriptions;

    public function __construct()
    {
        $this->subscriptions = new ArrayCollection();
        $this->userPlaylists = new ArrayCollection();
        $this->userComments = new ArrayCollection();
        $this->userWatchHistory = new ArrayCollection();
        $this->userSubscriptionHistory = new ArrayCollection();
        $this->playlistSubscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAccountStatus(): AccountStatus
    {
        return $this->accountStatus;
    }

    public function setAccountStatus(string $accountStatus): static
    {
        $this->accountStatus = $accountStatus;

        return $this;
    }

    public function getAccountRole(): Role
    {
        return $this->accountRole;
    }

    public function setAccountRole(Role $accountRole): static
    {
        $this->accountRole = $accountRole;

        return $this;
    }

    /**
     * @return Collection<int, Subscription>
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): static
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions->add($subscription);
            $subscription->addUser($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): static
    {
        if ($this->subscriptions->removeElement($subscription)) {
            $subscription->removeUser($this);
        }

        return $this;
    }

    public function getSubscriptionHistory(): ?SubscriptionHistory
    {
        return $this->subscriptionHistory;
    }

    public function setSubscriptionHistory(?SubscriptionHistory $subscriptionHistory): static
    {
        // unset the owning side of the relation if necessary
        if ($subscriptionHistory === null && $this->subscriptionHistory !== null) {
            $this->subscriptionHistory->setUserId(null);
        }

        // set the owning side of the relation if necessary
        if ($subscriptionHistory !== null && $subscriptionHistory->getUserId() !== $this) {
            $subscriptionHistory->setUserId($this);
        }

        $this->subscriptionHistory = $subscriptionHistory;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getUserPlaylists(): Collection
    {
        return $this->userPlaylists;
    }

    public function addUserPlaylist(Playlist $userPlaylist): static
    {
        if (!$this->userPlaylists->contains($userPlaylist)) {
            $this->userPlaylists->add($userPlaylist);
            $userPlaylist->setUser($this);
        }

        return $this;
    }

    public function removeUserPlaylist(Playlist $userPlaylist): static
    {
        if ($this->userPlaylists->removeElement($userPlaylist)) {
            // set the owning side to null (unless already changed)
            if ($userPlaylist->getUser() === $this) {
                $userPlaylist->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getUserComments(): Collection
    {
        return $this->userComments;
    }

    public function addUserComment(Comments $userComment): static
    {
        if (!$this->userComments->contains($userComment)) {
            $this->userComments->add($userComment);
            $userComment->setUser($this);
        }

        return $this;
    }

    public function removeUserComment(Comments $userComment): static
    {
        if ($this->userComments->removeElement($userComment)) {
            // set the owning side to null (unless already changed)
            if ($userComment->getUser() === $this) {
                $userComment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WatchHistoty>
     */
    public function getUserWatchHistory(): Collection
    {
        return $this->userWatchHistory;
    }

    public function addUserWatchHistory(WatchHistoty $userWatchHistory): static
    {
        if (!$this->userWatchHistory->contains($userWatchHistory)) {
            $this->userWatchHistory->add($userWatchHistory);
            $userWatchHistory->setUser($this);
        }

        return $this;
    }

    public function removeUserWatchHistory(WatchHistoty $userWatchHistory): static
    {
        if ($this->userWatchHistory->removeElement($userWatchHistory)) {
            // set the owning side to null (unless already changed)
            if ($userWatchHistory->getUser() === $this) {
                $userWatchHistory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SubscriptionHistory>
     */
    public function getUserSubscriptionHistory(): Collection
    {
        return $this->userSubscriptionHistory;
    }

    public function addUserSubscriptionHistory(SubscriptionHistory $userSubscriptionHistory): static
    {
        if (!$this->userSubscriptionHistory->contains($userSubscriptionHistory)) {
            $this->userSubscriptionHistory->add($userSubscriptionHistory);
            $userSubscriptionHistory->setUser($this);
        }

        return $this;
    }

    public function removeUserSubscriptionHistory(SubscriptionHistory $userSubscriptionHistory): static
    {
        if ($this->userSubscriptionHistory->removeElement($userSubscriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($userSubscriptionHistory->getUser() === $this) {
                $userSubscriptionHistory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaylistSubscription>
     */
    public function getPlaylistSubscriptions(): Collection
    {
        return $this->playlistSubscriptions;
    }

    public function addPlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if (!$this->playlistSubscriptions->contains($playlistSubscription)) {
            $this->playlistSubscriptions->add($playlistSubscription);
            $playlistSubscription->setUserPlaylist($this);
        }

        return $this;
    }

    public function removePlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if ($this->playlistSubscriptions->removeElement($playlistSubscription)) {
            // set the owning side to null (unless already changed)
            if ($playlistSubscription->getUserPlaylist() === $this) {
                $playlistSubscription->setUserPlaylist(null);
            }
        }

        return $this;
    }
}
