<?php declare(strict_types=1);

namespace Xtuple\Util\RegEx;

use PHPUnit\Framework\TestCase;

class RegExTest
  extends TestCase {
  private $pattern = '/
    (?:(\w+)\-)?                                        # prefix
    (?P<ip>
      (?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9])?\-){3} # first 3 parts of IP
      (?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9])           # last part of IP
    )                  
    \.(.*)                                              # base domain
  /x';

  public function testStruct() {
    $regex = new TestRegEx(new RegExPattern($this->pattern));
    self::assertEquals($this->pattern, (string) $regex);
    self::assertEquals($this->pattern, $regex->pattern());
    self::assertEquals(
      '255-249-199-99.example.com',
      $regex->replace('$2.example.com', 'ec2-255-249-199-99.compute-1.amazonaws.com')
    );
    self::assertEquals('255-249-199-99', $regex->group('ec2-255-249-199-99.compute-1.amazonaws.com', 'ip'));
    self::assertEquals('compute-1.amazonaws.com', $regex->group('ec2-255-249-199-99.compute-1.amazonaws.com', '3'));
  }

  public function testStructMatches() {
    $regex = new TestRegEx(new RegExPattern($this->pattern));
    self::assertEquals([
      'ec2-255-249-199-99.compute-1.amazonaws.com',
      'ec2',
      '255-249-199-99',
      'compute-1.amazonaws.com',
      'ip' => '255-249-199-99',
    ], $regex->matches('ec2-255-249-199-99.compute-1.amazonaws.com'));
    self::assertEquals([
      '255-249-199-99.compute-1.amazonaws.com',
      '',
      '255-249-199-99',
      'compute-1.amazonaws.com',
      'ip' => '255-249-199-99',
    ], $regex->matches('ec2-255-249-199-99.compute-1.amazonaws.com', false, 4));
    self::assertEquals([
      ['ec2-255-249-199-99.compute-1.amazonaws.com', 0],
      ['ec2', 0],
      ['255-249-199-99', 4],
      ['compute-1.amazonaws.com', 19],
      'ip' => ['255-249-199-99', 4],
    ], $regex->matches('ec2-255-249-199-99.compute-1.amazonaws.com', true));
    self::assertEquals([
      ['255-249-199-99.compute-1.amazonaws.com', 4],
      ['', -1],
      ['255-249-199-99', 4],
      ['compute-1.amazonaws.com', 19],
      'ip' => ['255-249-199-99', 4],
    ], $regex->matches('ec2-255-249-199-99.compute-1.amazonaws.com', true, 4));
  }

  public function testStructAll() {
    $regex = new TestRegEx(new RegExPattern($this->pattern));
    self::assertEquals([
      ['ec2-255-249-199-99.compute-1.amazonaws.com'],
      ['ec2'],
      ['255-249-199-99'],
      ['compute-1.amazonaws.com'],
      'ip' => ['255-249-199-99'],
    ], $regex->all('ec2-255-249-199-99.compute-1.amazonaws.com', false, false));
    self::assertEquals([
      [
        'ec2-255-249-199-99.compute-1.amazonaws.com',
        'ec2',
        '255-249-199-99',
        'compute-1.amazonaws.com',
        'ip' => '255-249-199-99',
      ],
    ], $regex->all('ec2-255-249-199-99.compute-1.amazonaws.com', true, false));
    self::assertEquals([
      [
        ['ec2-255-249-199-99.compute-1.amazonaws.com', 0],
        ['ec2', 0],
        ['255-249-199-99', 4],
        ['compute-1.amazonaws.com', 19],
        'ip' => ['255-249-199-99', 4],
      ],
    ], $regex->all('ec2-255-249-199-99.compute-1.amazonaws.com', true, true));
    self::assertEquals([
      [
        ['ec2-255-249-199-99.compute-1.amazonaws.com', 0],
      ],
      [
        ['ec2', 0],
      ],
      [
        ['255-249-199-99', 4],
      ],
      [
        ['compute-1.amazonaws.com', 19],
      ],
      'ip' => [
        ['255-249-199-99', 4],
      ],
    ], $regex->all('ec2-255-249-199-99.compute-1.amazonaws.com', false, true));
    self::assertEquals([
      [
        ['255-249-199-99.compute-1.amazonaws.com', 4],
        ['', -1],
        ['255-249-199-99', 4],
        ['compute-1.amazonaws.com', 19],
        'ip' => ['255-249-199-99', 4],
      ],
    ], $regex->all('ec2-255-249-199-99.compute-1.amazonaws.com', true, true, 4));
  }
}

final class TestRegEx
  extends AbstractRegEx {
}
