<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

abstract class MysqlDoctrineBaseRepository
{
    protected ObjectRepository $objectRepository;

    public function __construct(
        private ManagerRegistry $managerRegistry,
        public Connection $connection
    ) {
        $this->objectRepository = $this->getEntityManager()->getRepository($this->entityClass());
    }

    abstract protected static function entityClass(): string;


    protected function getEntityManager(): EntityManager | ObjectManager
    {
        $entityManager = $this->managerRegistry->getManager();

        if ($entityManager->isOpen()) {
            return $entityManager;
        }

        return $this->managerRegistry->resetManager();
    }


    protected function saveEntity(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    protected function removeEntity(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

}