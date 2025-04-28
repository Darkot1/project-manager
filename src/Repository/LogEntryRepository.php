<?php

namespace App\Repository;

use Gedmo\Loggable\Entity\LogEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LogEntry>
 */
class LogEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogEntry::class);
    }

    /**
     * Busca los registros de auditoría para una entidad específica
     */
    public function findLogsByEntity(string $entityClass, int $entityId): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.objectClass = :class')
            ->andWhere('l.objectId = :id')
            ->setParameter('class', $entityClass)
            ->setParameter('id', $entityId)
            ->orderBy('l.loggedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Busca los registros de auditoría por usuario
     */
    public function findLogsByUsername(string $username): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.username = :username')
            ->setParameter('username', $username)
            ->orderBy('l.loggedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Obtiene los registros de auditoría más recientes
     */
    public function findRecentLogs(int $limit = 50): array
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.loggedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Busca los registros por acción (created, updated, removed)
     */
    public function findLogsByAction(string $action): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.action = :action')
            ->setParameter('action', $action)
            ->orderBy('l.loggedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
