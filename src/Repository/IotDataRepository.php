<?php

namespace App\Repository;

use App\Entity\IotData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IotData|null find($id, $lockMode = null, $lockVersion = null)
 * @method IotData|null findOneBy(array $criteria, array $orderBy = null)
 * @method IotData[]    findAll()
 * @method IotData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IotDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IotData::class);
    }

    /**
     * Получаем данные по чипу
     * @param  string $value
     * @param  int $limit
     * @return IotData[]
     */
    public function findByChipId($chipid, $type, $limit = 100)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.chipid = :chipid')
            ->andWhere('i.valueType = :type')
            ->setParameter('chipid', $chipid)
            ->setParameter('type', $type)
            ->setMaxResults($limit)
            ->orderBy('i.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Получаем доступные данные по чипуам
     * @param  string $chipid
     */
    public function chipDataTypes($chipid)
    {
        return $this->createQueryBuilder('i')
            ->select('DISTINCT(i.valueType) as type')
            ->andWhere('i.chipid = :chipid')
            ->setParameter('chipid', $chipid)
            ->getQuery()
            ->getResult()
        ;
    }
}
