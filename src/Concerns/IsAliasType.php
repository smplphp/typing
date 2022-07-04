<?php

declare(strict_types=1);

namespace Smpl\Typing\Concerns;

trait IsAliasType
{
    use IsChildType;

    public function isAlias(): bool
    {
        return true;
    }
}