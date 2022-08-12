<?php

namespace Witrac\Infrastructure\Persistence\Doctrine\Repository\Canvas;

use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Canvas\Model\Exception\CanvasNotFoundException;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Infrastructure\Persistence\Doctrine\Repository\MysqlDoctrineBaseRepository;

class DoctrineCanvasRepository extends MysqlDoctrineBaseRepository implements CanvasRepository
{
    protected static function entityClass(): string
    {
        return Canvas::class;
    }

    public function save(Canvas $canvas): void
    {
        $this->saveEntity($canvas);
    }

    public function findByName(string $name): ?Canvas
    {
        if (null === $canvas = $this->objectRepository->findOneBy(['name' => $name])) {
           return null;
        }

        return $canvas;
    }

    public function deleteByName(string $name): void
    {
        $canvas = $this->findByName($name);
        if($canvas){
            $this->removeEntity($canvas);
        }
    }

    public function findByNameOrFail(string $name): Canvas
    {
        if (null === $canvas = $this->objectRepository->findOneBy(['name' => $name])) {
            CanvasNotFoundException::fromName($name);
        }

        return $canvas;
    }

}