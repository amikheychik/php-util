<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Message\Header\Header\ContentType\JSONContentTypeHeader;

class ArraySetHeaderTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testSet() {
    /** @var SetHeader $headers */
    $headers = new TestSetHeader(new ArraySetHeader([
      new JSONContentTypeHeader(),
    ]));
    self::assertEquals('application/json', $headers->get('Content-Type')->value());
    self::assertEquals(1, $headers->count());
    self::assertFalse($headers->isEmpty());
  }
}

final class TestSetHeader
  extends AbstractSetHeader {
}
