<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence\ArrayList\StrictType;

use PHPUnit\Framework\TestCase;

class StrictlyTypedArrayListTest
  extends TestCase {
  /**
   * @expectedException \Throwable
   * @expectedExceptionMessage All elements must be \stdClass. Element 0 of type \array given.
   * @throws \Throwable
   */
  public function testConstructor() {
    new StrictlyTypedArrayList(\stdClass::class);
    new StrictlyTypedArrayList(\stdClass::class, [
      (object) ['value' => 1],
    ]);
    new StrictlyTypedArrayList(\stdClass::class, [
      ['value' => 1],
    ]);
  }
}
