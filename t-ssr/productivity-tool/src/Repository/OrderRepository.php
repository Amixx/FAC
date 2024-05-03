<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function getCurrentOrder(): ?Order
    {
        return $this->findOneBy(['status' => Order::STATUS_PENDING]);
    }

    public function save(Order $order): void
    {
        $this->getEntityManager()->persist($order);
        $this->getEntityManager()->flush();
    }

    public function createNewOrder(): Order
    {
        $order = new Order();
        $order->setStatus(Order::STATUS_PENDING);
        $this->save($order);

        return $order;
    }
}
