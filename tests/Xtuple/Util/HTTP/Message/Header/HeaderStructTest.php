<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header;

use PHPUnit\Framework\TestCase;

final class HeaderStructTest
  extends TestCase {
  public function testConstructor() {
    $header = new HeaderStruct('Content-Type', 'application/json');
    self::assertEquals('Content-Type: application/json', (string) $header);
    self::assertEquals('Content-Type', $header->name());
    self::assertEquals('application/json', $header->value());
  }
}
