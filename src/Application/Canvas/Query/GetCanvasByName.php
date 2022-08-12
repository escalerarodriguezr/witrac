<?php
declare(strict_types=1);

namespace Witrac\Application\Canvas\Query;

use Witrac\Domain\Shared\Bus\Query\Query;

class GetCanvasByName implements Query
{

    public function __construct(
        private string $name
    )
    {
    }

    public function name(): string
    {
        return $this->name;
    }

}