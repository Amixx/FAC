<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    private ?User $author = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'repostedPosts')]
    private ?self $repostedPost = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'repostedPost')]
    private Collection $repostedPosts;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, PostLike>
     */
    #[ORM\OneToMany(targetEntity: PostLike::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $postLikes;

    public function __construct()
    {
        $this->repostedPosts = new ArrayCollection();
        $this->postLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getRepostedPost(): ?self
    {
        return $this->repostedPost;
    }

    public function setRepostedPost(?self $repostedPost): static
    {
        $this->repostedPost = $repostedPost;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRepostedPosts(): Collection
    {
        return $this->repostedPosts;
    }

    public function addRepostedPost(self $repostedPost): static
    {
        if (!$this->repostedPosts->contains($repostedPost)) {
            $this->repostedPosts->add($repostedPost);
            $repostedPost->setRepostedPost($this);
        }

        return $this;
    }

    public function removeRepostedPost(self $repostedPost): static
    {
        if ($this->repostedPosts->removeElement($repostedPost)) {
            // set the owning side to null (unless already changed)
            if ($repostedPost->getRepostedPost() === $this) {
                $repostedPost->setRepostedPost(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @return Collection<int, PostLike>
     */
    public function getPostLikes(): Collection
    {
        return $this->postLikes;
    }

    public function addPostLike(PostLike $postLike): static
    {
        if (!$this->postLikes->contains($postLike)) {
            $this->postLikes->add($postLike);
            $postLike->setPost($this);
        }

        return $this;
    }

    public function removePostLike(PostLike $postLike): static
    {
        if ($this->postLikes->removeElement($postLike)) {
            // set the owning side to null (unless already changed)
            if ($postLike->getPost() === $this) {
                $postLike->setPost(null);
            }
        }

        return $this;
    }

    public function hasBeenLikedBy(User $user): bool
    {
        return $this->postLikes->filter(function (PostLike $postLike) use ($user) {
                return $postLike->getAuthor()->getId() === $user->getId();
            })->count() > 0;
    }

    public function isAuthoredBy(User $user): bool
    {
        return $this->author->getId() === $user->getId();
    }
}
