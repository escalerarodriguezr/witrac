<?php
declare(strict_types=1);

namespace Witrac\Domain\Canvas\Repository;

use Witrac\Domain\Canvas\Model\Entity\Canvas;

interface CanvasRepository
{
    public function save(Canvas $canvas): void;
    public function findByName(string $name): ?Canvas;
    public function deleteByName(string $name): void;

}