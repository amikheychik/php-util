<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Header;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\AbstractAlgorithm;
use Xtuple\Util\JWT\Claim\Claim\Header\Type\TypeStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Subject\SubjectStruct;
use Xtuple\Util\JWT\Claim\Collection\Map\ArrayMapClaim;

class HeaderMapClaimStructTest
  extends TestCase {
  public function testEmptyConstructor() {
    $claims = new class (new HeaderMapClaimStruct())
      extends AbstractHeaderMapClaim {
    };
    self::assertEquals('none', $claims->algorithm()->value());
    self::assertEquals('none', $claims->get('alg')->value());
    self::assertEquals('JWT', $claims->get('typ')->value());
    self::assertEquals(2, $claims->count());
  }

  /**
   * @throws \Throwable
   */
  public function testFullConstructor() {
    $algorithm = new class ('algorithm')
      extends AbstractAlgorithm {
      public function sign(string $content): string {
        return '';
      }
    };
    $claims = new class (new HeaderMapClaimStruct($algorithm, new TypeStruct('type'), new ArrayMapClaim([
      new SubjectStruct('subject'),
    ])))
      extends AbstractHeaderMapClaim {
    };
    self::assertEquals('algorithm', $claims->algorithm()->value());
    self::assertEquals('algorithm', $claims->get('alg')->value());
    self::assertEquals('type', $claims->get('typ')->value());
    self::assertEquals('subject', $claims->get('sub')->value());
    self::assertNull($claims->get('iss'));
    self::assertEquals(3, $claims->count());
  }
}
