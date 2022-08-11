<?php
declare(strict_types=1);

namespace Witrac\Application\Canvas\Command;

use phpDocumentor\Reflection\PseudoTypes\NonEmptyString;
use Witrac\Domain\Shared\Bus\Command\Command;

class CreateCanvas implements Command
{

    private string $name;
    private int $width;
    private int $height;

    public function __construct(
        string $name,
        int $width,
        int $height
    )
    {
        $this->height = $height;
        $this->width = $width;
        $this->name = $name;
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


}