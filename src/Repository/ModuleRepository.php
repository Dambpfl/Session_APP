<?php

namespace App\Repository;

use App\Entity\Module;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Module>
 */
class ModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Module::class);
    }

    public function findNonProgrammes($session_id)
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();

        $qb = $sub;

        $qb->select('m')
           ->from('App\Entity\Module', 'm')
           ->leftJoin('m.programmes', 'mp')
           ->where('mp.session = :id');

        $sub = $em->createQueryBuilder();

        $sub->select('mo')
            ->from('App\Entity\Module', 'mo')
            ->where($sub->expr()->notIn('mo.id', $qb->getDQL()))
            ->setParameter('id', $session_id)
            ->orderBy('mo.nomModule');

        $query = $sub->getQuery();
        return $query->getResult();

        /* Equivalent requete SQL
            SELECT module.nom_module
            FROM module
            WHERE module.id NOT IN (
		        SELECT programme.module_id 
		        FROM programme
		        WHERE session_id = 5)
        */
    }

    //    /**
    //     * @return Module[] Returns an array of Module objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Module
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
