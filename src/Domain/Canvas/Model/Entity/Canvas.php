<?php
declare(strict_types=1);

namespace Witrac\Domain\Canvas\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Witrac\Domain\Canvas\Model\Exception\SpaceshipCollisionException;
use Witrac\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;

class Canvas
{
    private string $id;
    private string $name;
    private int $width;
    private int $height;
    private Spaceship $spaceship;
    private Collection $blocks;

    public function __construct(
        string $id,
        string $name,
        int $width,
        int $height,
        Spaceship $spaceship
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;
        $this->spaceship = $spaceship;
        $this->blocks = new ArrayCollection();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function spaceship(): Spaceship
    {
        return $this->spaceship;
    }


    public function blocks(): Collection
    {
        return $this->blocks;
    }

    public function addRandomBlocks(int $numberOfBlocks, IdentifierGenerator $identifierGenerator):void
    {
        if($numberOfBlocks){
             for ($i=0; $i<$numberOfBlocks; $i++){
                $this->blocks->add(
                    new Block(
                        $identifierGenerator->uuid(),
                        rand(1,$this->width),
                        rand(1,$this->height),
                        $this
                    )
                );
             }
        }

    }

    public function checkSpaceshipCollision(Spaceship $spaceship): void
    {
        if( $this->blocks()->count() ){
            foreach ($this->blocks() as $block){
                if( $block->positionX() == $spaceship->positionX() && $block->positionY() == $spaceship->positionY() ){
                    SpaceshipCollisionException::whithBlock($block);
                }
            }
        }

    }

}