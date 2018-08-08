<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map\Base64;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt\IssuedAtStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Subject\SubjectStruct;
use Xtuple\Util\JWT\Claim\ClaimStruct;
use Xtuple\Util\JWT\Claim\Collection\Map\ArrayMapClaim;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

class URLSafeBase64EncodedMapClaimTest
  extends TestCase {
  /**
   * @see https://jwt.io
   * @throws \Throwable
   */
  public function testEncoding() {
    /** @noinspection SpellCheckingInspection */
    $jwtIO = 'eyJpYXQiOjE1MTYyMzkwMjJ9';
    self::assertEquals($jwtIO, base64_encode(json_encode([
      'iat' => 1516239022,
    ])));
    self::assertEquals($jwtIO, (string) new URLSafeBase64EncodedMapClaim(new ArrayMapClaim([
      new IssuedAtStruct(new DateTimeTimestampSeconds(1516239022)),
    ])));
    /** @noinspection SpellCheckingInspection */
    $jwtIO = 'eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ';
    self::assertEquals("{$jwtIO}==", base64_encode(json_encode([
      'sub' => '1234567890',
      'name' => 'John Doe',
      'iat' => 1516239022,
    ])));
    self::assertEquals($jwtIO, (string) new URLSafeBase64EncodedMapClaim(new ArrayMapClaim([
      new SubjectStruct('1234567890'),
      new ClaimStruct('name', 'John Doe'),
      new IssuedAtStruct(new DateTimeTimestampSeconds(1516239022)),
    ])));
    self::assertEquals('e30', (string) new URLSafeBase64EncodedMapClaim(new ArrayMapClaim()));
  }
}
