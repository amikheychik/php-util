<?php
/** @noinspection PhpParamsInspection */
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Generics\Type\NullableScalarType;
use Xtuple\Util\Generics\Type\NullableType;
use Xtuple\Util\Generics\Type\ResourceType;
use Xtuple\Util\Generics\Type\ScalarType;
use Xtuple\Util\Generics\Type\StrictType;

$type = new StrictType(\Countable::class);
$array = new \ArrayObject();
/** @noinspection PhpUnhandledExceptionInspection - \ArrayObject implements \Countable */
$type->cast($array) === $array; // returns the same object instance as it receives
try {
  $type->cast([]);
}
catch (TypeThrowable $e) {
  // Throws an exception, as an array is passed
}
try {
  $type->cast(new \stdClass());
}
catch (TypeThrowable $e) {
  // Throws an exception, as \stdClass does not implement \Countable
}

$scalar = new ScalarType();
/** @noinspection PhpUnhandledExceptionInspection - passed scalar */
$scalar->cast(1) === 1;
try {
  $scalar->cast(null);
}
catch (TypeThrowable $e) {
  // Throws an exception, null is not a scalar.
}

$resource = new ResourceType();
/** @noinspection PhpUnhandledExceptionInspection - passed resource */
$resource->cast(tmpfile()); // Returns resource handler created by tmpfile()
try {
  $resource->cast(new \stdClass());
}
catch (TypeThrowable $e) {
  // Throws an exception, as \stdClass() is not a resource.
}

// Class/interface names may be passed as strings.
$nullableType = new NullableType('\stdClass'); // <1>
/** @noinspection PhpUnhandledExceptionInspection - null is accepted */
$nullableType->cast(null) === null; // Returns null, instead of throwing an exception (unlike StrictType)

$nullableScalar = new NullableScalarType();
/** @noinspection PhpUnhandledExceptionInspection - null is accepted */
$nullableScalar->cast(null) === null; // Returns null, instead of throwing an exception
