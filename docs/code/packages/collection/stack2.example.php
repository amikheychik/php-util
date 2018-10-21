<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Collection\Stack\ArrayStack\StrictType\StrictlyTypedArrayStack;

/** @noinspection PhpUnhandledExceptionInspection - types are verified */
$stack = new StrictlyTypedArrayStack(\stdClass::class, [
  (object) ['value' => 'one'],
  (object) ['value' => 'two'],
]);

/** @noinspection PhpUnhandledExceptionInspection - type is verified */
$stack->push((object) ['value' => 'three']) === 3; // Returns size of the updated stack
$stack->pop()->value === 'three';

try {
  $stack->push('three');
}
catch (Throwable $e) {
  // Throws an exception, as string is passed, not a \stdClass
}
