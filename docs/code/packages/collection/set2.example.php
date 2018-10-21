<?php
/** @noinspection PhpExpressionResultUnusedInspection */
/** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

use Xtuple\Util\Collection\Set\ArraySet\StrictType\StrictlyTypedArraySet;

final class Country {
  /** @var string */
  private $code;
  /** @var string */
  private $name;

  public function __construct(string $code, string $name) {
    $this->code = $code;
    $this->name = $name;
  }

  public function code(): string {
    return $this->code;
  }

  public function name(): string {
    return $this->name;
  }
}

/** @noinspection PhpUnhandledExceptionInspection - types are verified */
$map = new StrictlyTypedArraySet(Country::class, [
  'USA' => new Country('US', 'United States'),
  'CAN' => new Country('CA', 'Canada'),
]);

// $map is Set<Country>
$map->get('USA') instanceof Country;

/** @noinspection PhpUnhandledExceptionInspection - types are verified */
$map = new StrictlyTypedArraySet(
  Country::class,
  [
    'USA' => new Country('US', 'United States'),
    'CAN' => new Country('CA', 'Canada'),
  ],
  // $key parameter can be specified to provide name of the key method.
  // Key method must not require any parameters.
  'code'
);

// Country::code() is used as set keys
$map->get('US')->name() === 'United States';

try {
  $map = new StrictlyTypedArraySet(Country::class, [
    'USA' => new Country('US', 'United States'),
    'CAN' => new Country('CA', 'Canada'),
    'US' => new Country('US', 'United States'),
  ], 'code');
}
catch (Throwable $e) {
  // Throws an exception, as code 'US' is duplicated.
}
