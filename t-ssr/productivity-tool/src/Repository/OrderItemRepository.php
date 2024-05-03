<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderItem>
 */
class OrderItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderItem::class);
    }

    public static function createNewOrderItem(Product $product, Order $order): OrderItem
    {
        $orderItem = new OrderItem();
        $orderItem->setOrderr($order);
        $orderItem->setProduct($product);
        $orderItem->setAmount(1);
        $order->addOrderItem($orderItem);

        return $orderItem;
    }

    public function save(OrderItem $orderItem): void
    {
        $this->getEntityManager()->persist($orderItem);
        $this->getEntityManager()->flush();
    }

    public function remove(OrderItem $orderItem): void
    {
        $this->getEntityManager()->remove($orderItem);
        $this->getEntityManager()->flush();
    }
}
