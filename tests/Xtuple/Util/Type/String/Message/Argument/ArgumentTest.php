<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\ArraySetArgument;
use Xtuple\Util\Type\String\Message\Message\MessageStruct;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

class ArgumentTest
  extends TestCase {
  public function testAbstract() {
    $argument = new TestArgument('test', 'abstract');
    self::assertEquals('test', $argument->key());
    self::assertEquals('abstract', $argument->template());
    self::assertEquals('abstract', (string) $argument);
    self::assertTrue($argument->arguments()->isEmpty());
  }

  public function testWithTokens() {
    $message = new MessageStruct('API request failed: {error}', new ArraySetArgument([
      new ArgumentWithTokens('error', '({code}) {message}', [
        'code' => 1024,
        'message' => 'Access denied',
      ]),
    ]));
    self::assertEquals('API request failed: (1024) Access denied', $message->__toString());
    self::assertEquals('API request failed: {error}', $message->template());
    self::assertEquals('(1024) Access denied', $message->arguments()->get('error')->__toString());
    self::assertEquals('({code}) {message}', $message->arguments()->get('error')->template());
  }
}

final class TestArgument
  extends AbstractArgument {
  public function __construct(string $key, string $value) {
    parent::__construct($key, new StringMessage($value));
  }
}
