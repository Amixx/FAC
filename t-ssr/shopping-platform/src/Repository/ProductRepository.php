<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findPopularProducts(int $limit = 6): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.popularity', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findNewProducts(int $limit = 6): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findProductsWithDiscounts(int $limit = 6): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.discount IS NOT NULL')
            ->orderBy('p.discount', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findProducts(int $page = 1): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(10)
            ->setFirstResult(($page - 1) * 10)
            ->getQuery()
            ->getResult();
    }

    public function findProductsByCategory(string $category, int $page = 1): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.category', 'product_category')
            ->where('product_category.name = :category')
            ->setParameter('category', $category)
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(10)
            ->setFirstResult(($page - 1) * 10)
            ->getQuery()
            ->getResult();
    }
}
