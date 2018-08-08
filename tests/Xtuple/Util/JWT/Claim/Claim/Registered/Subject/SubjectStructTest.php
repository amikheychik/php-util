<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Registered\Subject;

use PHPUnit\Framework\TestCase;

class SubjectStructTest
  extends TestCase {
  public function testConstructor() {
    $claim = new class (new SubjectStruct('subject'))
      extends AbstractSubject {
    };
    self::assertEquals('sub', $claim->name());
    self::assertEquals('subject', $claim->value());
    self::assertEquals('sub: subject', (string) $claim);
  }
}
