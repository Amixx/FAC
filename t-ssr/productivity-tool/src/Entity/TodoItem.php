<?php

namespace App\Entity;

use App\Repository\TodoItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoItemRepository::class)]
class TodoItem
{
    const STATUS_TODO = 'todo';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_DONE = 'DONE';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $deadline = null;

    #[ORM\Column]
    private ?bool $important = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'todoItems')]
    private ?TodoItemCategory $category = null;

    /**
     * @var Collection<int, SpentTime>
     */
    #[ORM\OneToMany(targetEntity: SpentTime::class, mappedBy: 'todoItem', orphanRemoval: true)]
    private Collection $spentTimes;

    public function __construct()
    {
        $this->spentTimes = new ArrayCollection();
    }

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

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function isImportant(): ?bool
    {
        return $this->important;
    }

    public function setImportant(bool $important): static
    {
        $this->important = $important;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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

    public function getCategory(): ?TodoItemCategory
    {
        return $this->category;
    }

    public function setCategory(?TodoItemCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, SpentTime>
     */
    public function getSpentTimes(): Collection
    {
        return $this->spentTimes;
    }

    public function addSpentTime(SpentTime $spentTime): static
    {
        if (!$this->spentTimes->contains($spentTime)) {
            $this->spentTimes->add($spentTime);
            $spentTime->setTodoItem($this);
        }

        return $this;
    }

    public function removeSpentTime(SpentTime $spentTime): static
    {
        if ($this->spentTimes->removeElement($spentTime)) {
            // set the owning side to null (unless already changed)
            if ($spentTime->getTodoItem() === $this) {
                $spentTime->setTodoItem(null);
            }
        }

        return $this;
    }
}
