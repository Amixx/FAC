<?php

namespace App\Repository;

use App\Entity\TodoItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TodoItem>
 */
class TodoItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TodoItem::class);
    }

    public function findTodoItems(int $page = 1, int $itemsPerPage = 10): array
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->orderBy('t.createdAt', 'DESC')
            ->setMaxResults($itemsPerPage)
            ->setFirstResult(($page - 1) * $itemsPerPage)
            ->getQuery()
            ->getResult();
    }

    public function findTodoItemsCount(): int
    {
        return $this->createQueryBuilder('t')
            ->select('count(t)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
