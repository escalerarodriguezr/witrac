<?php

namespace Witrac\Domain\Shared\Service\IdentifierGenerator;

interface IdentifierGenerator
{
    public function uuid():string;
}