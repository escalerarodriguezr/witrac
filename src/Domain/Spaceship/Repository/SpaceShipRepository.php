<?php
declare(strict_types=1);

namespace Witrac\Domain\Spaceship\Repository;

use Witrac\Domain\Spaceship\Model\Entity\Spaceship;

interface SpaceShipRepository
{
    public function save(Spaceship $spaceship): void;

}