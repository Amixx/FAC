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

    public function getFormattedDuration(): string
    {
        $parts = [];
        $interval = $this->duration; // Assuming $this->duration is a DateInterval object

        if ($interval->y > 0) {
            $parts[] = $interval->y . ' ' . ($interval->y == 1 ? 'year' : 'years');
        }
        if ($interval->m > 0) {
            $parts[] = $interval->m . ' ' . ($interval->m == 1 ? 'month' : 'months');
        }
        if ($interval->d > 0) {
            $parts[] = $interval->d . ' ' . ($interval->d == 1 ? 'day' : 'days');
        }
        if ($interval->h > 0) {
            $parts[] = $interval->h . ' ' . ($interval->h == 1 ? 'hour' : 'hours');
        }
        if ($interval->i > 0) {
            $parts[] = $interval->i . ' ' . ($interval->i == 1 ? 'minute' : 'minutes');
        }
        if ($interval->s > 0) {
            $parts[] = $interval->s . ' ' . ($interval->s == 1 ? 'second' : 'seconds');
        }

        return implode(', ', $parts) ?: '0 seconds'; // Returns '0 seconds' if all parts are zero
    }
}
