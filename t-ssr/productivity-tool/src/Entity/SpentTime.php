<?php

namespace App\Entity;

use App\Repository\SpentTimeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpentTimeRepository::class)]
class SpentTime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateInterval $duration = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'spentTimes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TodoItem $todoItem = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuration(): ?\DateInterval
    {
        return $this->duration;
    }

    public function setDuration(\DateInterval $duration): static
    {
        $this->duration = $duration;

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

    public function getTodoItem(): ?TodoItem
    {
        return $this->todoItem;
    }

    public function setTodoItem(?TodoItem $todoItem): static
    {
        $this->todoItem = $todoItem;

        return $this;
    }
}
