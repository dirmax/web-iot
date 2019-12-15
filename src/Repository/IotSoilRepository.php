<?php

namespace App\Repository;

use App\Entity\IotSoil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IotSoil|null find($id, $lockMode = null, $lockVersion = null)
 * @method IotSoil|null findOneBy(array $criteria, array $orderBy = null)
 * @method IotSoil[]    findAll()
 * @method IotSoil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IotSoilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IotSoil::class);
    }

    /**
     * Получаем данные по чипу
     * @param  string $value
     * @param  int $limit
     * @return IotSoil[]
     */
    public function findByChipId($chipid, $limit = 100)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.chipid = :val')
            ->setParameter('val', $chipid)
            ->setMaxResults($limit)
            ->orderBy('i.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
