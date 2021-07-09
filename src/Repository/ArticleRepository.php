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

            ->leftJoin('article.category', 'category')
            ->leftJoin('article.tag', 'tag')

            ->where('article.content LIKE :term')
            ->orWhere('article.title LIKE :term')
            ->orWhere('category.title LIKE :term')
            ->orWhere('tag.title LIKE :term')

            ->setParameter('term', '%'.$term.'%')
            ->getQuery();

        return $query->getResult();
    }

}
