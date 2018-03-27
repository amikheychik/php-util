<?php declare(strict_types=1);

namespace Xtuple\Util\RegEx;

use PHPUnit\Framework\TestCase;

class RegExTest
  extends TestCase {
  public function testStruct() {
    $regex = new TestRegEx(new RegExPattern('/(a+)(b*(c))(d?)/'));
    self::assertEquals('/(a+)(b*(c))(d?)/', (string) $regex);
    self::assertEquals('/(a+)(b*(c))(d?)/', $regex->pattern());
    self::assertEquals('bcdaaa', $regex->replace('$2d$1', 'aaabc'));
    self::assertEquals('aaa', $regex->group('aaabc', '1'));
  }

  public function testStructMatches() {
    $regex = new TestRegEx(new RegExPattern('/(a+)(b*(c))(d?)/'));
    self::assertEquals([
      'aaabc',
      'aaa',
      'bc',
      'c',
      '',
    ], $regex->matches('aaabc'));
    self::assertEquals([
      'abc',
      'a',
      'bc',
      'c',
      '',
    ], $regex->matches('aaabc', false, 2));
    self::assertEquals([
      ['aaabc', 0],
      ['aaa', 0],
      ['bc', 3],
      ['c', 4],
      ['', 5],
    ], $regex->matches('aaabc', true));
    self::assertEquals([
      ['abc', 2],
      ['a', 2],
      ['bc', 3],
      ['c', 4],
      ['', 5],
    ], $regex->matches('aaabc', true, 2));
  }

  public function testStructAll() {
    $regex = new TestRegEx(new RegExPattern('/(a+)(b*(c))(d?)/'));
    self::assertEquals([
      ['abc', 'aacd', 'aaabc'],
      ['a', 'aa', 'aaa'],
      ['bc', 'c', 'bc'],
      ['c', 'c', 'c'],
      ['', 'd', ''],
    ], $regex->all('abc-aacd-aaabc'));
    self::assertEquals([
      [['abc', 0], ['aacd', 4], ['aaabc', 9]],
      [['a', 0], ['aa', 4], ['aaa', 9]],
      [['bc', 1], ['c', 6], ['bc', 12]],
      [['c', 2], ['c', 6], ['c', 13]],
      [['', 3], ['d', 7], ['', 14]],
    ], $regex->all('abc-aacd-aaabc', false, true));
    self::assertEquals([
      ['abc', 'a', 'bc', 'c', ''],
      ['aacd', 'aa', 'c', 'c', 'd'],
      ['aaabc', 'aaa', 'bc', 'c', ''],
    ], $regex->all('abc-aacd-aaabc', true));
    self::assertEquals([
      [['abc', 0], ['a', 0], ['bc', 1], ['c', 2], ['', 3]],
      [['aacd', 4], ['aa', 4], ['c', 6], ['c', 6], ['d', 7]],
      [['aaabc', 9], ['aaa', 9], ['bc', 12], ['c', 13], ['', 14]],
    ], $regex->all('abc-aacd-aaabc', true, true));
  }
}

final class TestRegEx
  extends AbstractRegEx {
}
