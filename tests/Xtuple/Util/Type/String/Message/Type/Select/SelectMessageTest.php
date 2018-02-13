<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Select;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\String\Message\Argument\ArgumentFromString;
use Xtuple\Util\Type\String\Message\Argument\ArgumentWithTokens;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\ArraySetArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

class SelectMessageTest
  extends TestCase {
  public function testStruct() {
    $argument = new SelectArgumentStruct(
      'test',
      new SelectMessageStruct('other', new StringMessage('an {animal}'), new ArraySetArgument([
        new StringArgument('dog', 'a dog'),
        new StringArgument('cat', 'a cat'),
      ]), new ArraySetArgument([
        new StringArgument('animal', 'unknown animal'),
      ]))
    );
    self::assertEquals('test', $argument->key());
    self::assertEquals('an unknown animal', $argument->__toString());
    self::assertEquals('an {animal}', $argument->template());
    self::assertEquals('other', $argument->value());
    self::assertEquals('an {animal}', $argument->default()->template());
    self::assertEquals('a dog', $argument->options()->get('dog')->__toString());
    self::assertEquals('a cat', $argument->options()->get('cat')->__toString());
    self::assertEquals('unknown animal', $argument->arguments()->get('animal')->__toString());
  }

  public function testSelectString() {
    $select = new SelectMessageFromStrings('other', 'an animal');
    self::assertEquals('an animal', (string) $select);
    self::assertEquals('a dog', (string) new SelectMessageFromStrings('a', 'an animal', [
      'a' => 'a {animal}',
      'an' => 'an {animal}',
    ], new ArraySetArgument([
      new StringArgument('animal', 'dog'),
    ])));
  }

  public function testSelectMessage() {
    $select = new SelectMessageStruct(
      'macos',
      new StringMessage('OS is not supported.'),
      new ArraySetArgument([
        new ArgumentFromString('macos', 'MacOSX {version} {name}', new ArraySetArgument([
          new StringArgument('name', 'High Sierra'),
        ])),
        new ArgumentWithTokens('ubuntu', 'Ubuntu {version} {name}', [
          'name' => 'Xenial Xerus',
        ]),
      ]),
      new ArraySetArgument([
        new StringArgument('version', '10.13.3'),
      ])
    );
    self::assertEquals('MacOSX 10.13.3 High Sierra', (string) $select);
  }
}
