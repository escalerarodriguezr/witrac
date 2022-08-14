<?php
declare(strict_types=1);

namespace Witrac\Application\Canvas\Command;

use Witrac\Domain\Shared\Bus\Command\Command;

class CreateCanvas implements Command
{

    public function __construct(
        private string $name,
        private int $width,
        private int $height,
        private int $numberOfRandomBlocks
    )
    {

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

    public function numberOfRandomBlocks(): int
    {
        return $this->numberOfRandomBlocks;
    }

}