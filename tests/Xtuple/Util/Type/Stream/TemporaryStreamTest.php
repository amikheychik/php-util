<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Stream;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\Stream\String\StringStreamStruct;

final class TemporaryStreamTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $stream = new TemporaryStream();
    self::assertEquals('', new StringStreamStruct($stream));
  }
}
