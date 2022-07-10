<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Fixtures;

class InvokableClass extends BasicClass
{
    public function __invoke(): string
    {
        return 'I am invokable';
    }
}