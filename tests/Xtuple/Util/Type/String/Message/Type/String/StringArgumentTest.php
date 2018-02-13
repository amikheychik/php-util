<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\String;

use PHPUnit\Framework\TestCase;

class StringArgumentTest
  extends TestCase {
  public function testString() {
    $message = new StringMessage('Undefined');
    self::assertEquals('Undefined', $message->__toString());
    self::assertEquals('Undefined', $message->template());
    $argument = new StringArgument('test', 'string');
    self::assertEquals('test', $argument->key());
    self::assertEquals('string', $argument->template());
    self::assertEquals('string', $argument->__toString());
    self::assertTrue($argument->arguments()->isEmpty());
  }
}
