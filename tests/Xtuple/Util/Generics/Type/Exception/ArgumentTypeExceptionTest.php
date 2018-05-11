<?php declare(strict_types=1);

namespace Xtuple\Util\Generics\Type\Exception;

use PHPUnit\Framework\TestCase;

class ArgumentTypeExceptionTest
  extends TestCase {
  public function testConstructorDefaults() {
    $exception = new ArgumentTypeException('string', 'array');
    self::assertEquals('Argument 1 must be of the type string, instance of array given', $exception->getMessage());
    self::assertNull($exception->getPrevious());
  }
}
