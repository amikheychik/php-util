<?php declare(strict_types=1);

namespace Xtuple\Util\Exception\Undefined\Method;

use PHPUnit\Framework\TestCase;

class UndefinedMethodExceptionTest
  extends TestCase {
  public function testException() {
    $e = new UndefinedMethodException(\stdClass::class, 'get');
    self::assertEquals('Method \stdClass::get() is undefined', $e->getMessage());
  }
}
