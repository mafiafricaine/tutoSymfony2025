<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

       /**
        * @return Recipe[] Returns an array of Recipe objects
        * Cette methode permet de recuperer les recettes qui ont moins d'une durée donnée en paramètre
        */
       public function findRecipeDurationLowerThan(int $duration): array
       {
           return $this->createQueryBuilder('r')
               ->where('r.duration <= :duration')
               ->setParameter('duration', $duration)
               ->orderBy('r.duration', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?Recipe
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
