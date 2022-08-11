<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Persistence\Doctrine\Repository\Spaceship;

use Witrac\Domain\Spaceship\Model\Entity\Spaceship;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;
use Witrac\Infrastructure\Persistence\Doctrine\Repository\MysqlDoctrineBaseRepository;

class DoctrineSpaceshipRepository extends MysqlDoctrineBaseRepository implements SpaceShipRepository
{
    protected static function entityClass(): string
    {
        return Spaceship::class;
    }

    public function save(Spaceship $spaceship): void
    {
        $this->saveEntity($spaceship);
    }

}