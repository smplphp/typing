<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Fixtures;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

enum BasicEnum
{
    case ONE;
    case TWO;
}