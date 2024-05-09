<?php

namespace App\Repository;

use App\Entity\PostLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostLike>
 */
class PostLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostLike::class);
    }

    public function save(PostLike $postLike): void
    {
        $this->getEntityManager()->persist($postLike);
        $this->getEntityManager()->flush();
    }

    public function remove(PostLike $postLike): void
    {
        $this->getEntityManager()->remove($postLike);
        $this->getEntityManager()->flush();
    }
}
