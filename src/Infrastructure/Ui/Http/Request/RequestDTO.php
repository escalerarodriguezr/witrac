<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Ui\Http\Request;

use Symfony\Component\HttpFoundation\Request;


interface RequestDTO
{
    public function __construct(Request $request);
}