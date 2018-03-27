<?php declare(strict_types=1);

namespace Xtuple\Util\RegEx\String;

use PHPUnit\Framework\TestCase;

class NewLineRegExTest
  extends TestCase {
  public function testRegEx() {
    $regex = new NewLineRegEx();
    self::assertEquals('/(\r\n?|\n)/', (string) $regex);
    self::assertEquals('/(\r\n?|\n)/', $regex->pattern());
    $lines = ['First', 'Second', 'Third'];
    $string = implode("\r", $lines);
    self::assertEquals(["\r", "\r"], $regex->matches($string));
    self::assertEquals([["\r", "\r"], ["\r", "\r"]], $regex->all($string));
    self::assertEquals("First\nSecond\nThird", $regex->replace("\n", $string));
    self::assertEquals("\r", $regex->group($string, '0'));
    self::assertEquals('', $regex->group($string, '2'));
    $string = implode("\r\n", $lines);
    self::assertEquals(["\r\n", "\r\n"], $regex->matches($string));
    self::assertEquals([["\r\n", "\r\n"], ["\r\n", "\r\n"]], $regex->all($string));
    self::assertEquals("First\nSecond\nThird", $regex->replace("\n", $string));
    self::assertEquals("\r\n", $regex->group($string, '0'));
    self::assertEquals('', $regex->group($string, '2'));
    $string = implode("\n", $lines);
    self::assertEquals(["\n", "\n"], $regex->matches($string));
    self::assertEquals([["\n", "\n"], ["\n", "\n"]], $regex->all($string));
    self::assertEquals("First\rSecond\rThird", $regex->replace("\r", $string));
    self::assertEquals("\n", $regex->group($string, '0'));
    self::assertEquals('', $regex->group($string, '2'));
  }
}
