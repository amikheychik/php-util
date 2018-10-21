<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Collection\Stack\ArrayStack\ArrayStack;

// Initial state may be provided
$stack = new ArrayStack(['one', 'two']);

$stack->push('three') === 3; // Returns size of the updated stack
$stack->pop() === 'three';
