<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Argument;

use PHPUnit\Framework\TestCase;
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
}

final class TestArgument
  extends AbstractArgument {
  public function __construct(string $key, string $value) {
    parent::__construct($key, new StringMessage($value));
  }
}
