<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function searchByTerm($term)
    {
        $queryBuilder = $this->createQueryBuilder('article');

        $query = $queryBuilder
            ->select('article')

            ->where('article.content LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->getQuery();

        return $query->getResult();
    }

}
