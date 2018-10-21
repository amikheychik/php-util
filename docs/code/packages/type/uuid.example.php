<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\UUID\OptionalUUIDString;
use Xtuple\Util\Type\UUID\UUIDString;
use Xtuple\Util\Type\UUID\UUIDv4;

/** @noinspection PhpUnhandledExceptionInspection - unlikely */
$uuid = new UUIDv4(); // <1>
// Returns generated UUID:
(string) $uuid;
// Returns generated UUID as Uniform Resource Name (URN):
$uuid->urn();
// UUIDs can be checked for equality.
/** @noinspection PhpUnhandledExceptionInspection - unlikely */
$uuid->equals(new UUIDv4());

// An exception is thrown, if passed string is not a valid UUID
/** @noinspection PhpUnhandledExceptionInspection - passed valid UUID */
$uuid = new UUIDString((string) $uuid);

// If input may not be a valid UUID,
// and exception check is undesired,
// use Optional
$optional = new OptionalUUIDString((string) $uuid);
// Returns true, if UUID is valid
$optional->isPresent();
// Returns UUID object, if UUID is valid; returns null otherwise
$optional->value();
