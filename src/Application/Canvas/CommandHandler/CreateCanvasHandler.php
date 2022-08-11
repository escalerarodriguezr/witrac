<?php
declare(strict_types=1);

namespace Witrac\Application\Canvas\CommandHandler;

use Witrac\Application\Canvas\Command\CreateCanvas;
use Witrac\Domain\Shared\Bus\Command\CommandHandler;

class CreateCanvasHandler implements CommandHandler
{


    public function __construct()
    {
    }

    public function __invoke(CreateCanvas $createCanvas): void
    {

        // TODO: Implement __invoke() method.
    }


}