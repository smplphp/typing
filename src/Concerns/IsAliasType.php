<?php

declare(strict_types=1);

namespace Smpl\Typing\Concerns;

use Smpl\Typing\Contracts\Type;

trait IsAliasType
{
    use IsChildType;

    public function isAlias(): bool
    {
        return true;
    }
}