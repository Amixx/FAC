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

    public function findTodoItems($maxResults = 10, bool $includeCompleted = false): array
    {
        $queryBuilder = $this->createQueryBuilder('t')
            ->select('t')
            ->orderBy('t.deadline', 'ASC');

        if (!$includeCompleted) {
            $queryBuilder->andWhere('t.status != :status')
                ->setParameter('status', TodoItem::STATUS_DONE);
        }

        return $queryBuilder->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();
    }

    public function findTodoItemsCount(bool $includeCompleted = false): int
    {
        $queryBuilder = $this->createQueryBuilder('t')
            ->select('count(t)')
            ->andWhere('t.status != :status')
            ->setParameter('status', TodoItem::STATUS_DONE);

        if ($includeCompleted) {
            $queryBuilder->orWhere('t.status = :status')
                ->setParameter('status', TodoItem::STATUS_TODO);
        }

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    public function save(TodoItem $todoItem): void
    {
        $this->getEntityManager()->persist($todoItem);
        $this->getEntityManager()->flush();
    }

    public function remove(TodoItem $todoItem): void
    {
        $this->getEntityManager()->remove($todoItem);
        $this->getEntityManager()->flush();
    }
}
