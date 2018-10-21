<?php
/** @noinspection AutoloadingIssuesInspection */
declare(strict_types=1);

use Xtuple\Util\Collection\Sequence\ArrayList\StrictType\AbstractStrictlyTypedArrayList;

/**
 * ArrayList<stdClass>
 */
final class ArrayListStdClass
  extends AbstractStrictlyTypedArrayList // <1>
  implements ListStdClass { // <2>
  /** @var string */
  private $name;

  /**
   * @throws Throwable
   *
   * @param \stdClass[] $elements <3>
   * @param string      $name
   */
  public function __construct(array $elements = [], string $name = '') {
    parent::__construct(\stdClass::class, $elements); // <4>
    $this->name = $name;
  }

  public function name(): string { // <5>
    return $this->name;
  }
}
