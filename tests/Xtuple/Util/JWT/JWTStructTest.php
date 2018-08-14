<?php declare(strict_types=1);

namespace Xtuple\Util\JWT;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Exception\Exception;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\AbstractOpenSSLAlgorithm;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\Keypair;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\RS256OpenSSL;
use Xtuple\Util\JWT\Claim\Claim\Registered\IssuedAt\IssuedAtStruct;
use Xtuple\Util\JWT\Claim\Claim\Registered\Subject\SubjectStruct;
use Xtuple\Util\JWT\Claim\ClaimStruct;
use Xtuple\Util\JWT\Claim\Collection\Map\ArrayMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Header\HeaderMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Header\HeaderMapClaimStruct;
use Xtuple\Util\JWT\Claim\Collection\Map\Payload\PayloadMapClaim;
use Xtuple\Util\JWT\Claim\Collection\Map\Payload\PayloadMapClaimStruct;
use Xtuple\Util\JWT\Claim\Collection\Map\Registered\RegisteredMapClaimStruct;
use Xtuple\Util\JWT\Test\RSA256FromJWTIO;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\URLSafeBase64EncodedStringFromString;

class JWTStructTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testUnsignedJWT() {
    $jwt = new TestJWT(
      new JWTStruct(new HeaderMapClaimStruct(), new PayloadMapClaimStruct(
        new RegisteredMapClaimStruct(),
        new ArrayMapClaim(),
        new ArrayMapClaim()
      ))
    );
    $header = new URLSafeBase64EncodedStringFromString('{"typ":"JWT","alg":"none"}');
    $payload = new URLSafeBase64EncodedStringFromString('{}');
    self::assertEquals("{$header}.{$payload}", $jwt->encoded());
    self::assertEquals(2, $jwt->header()->count());
    self::assertEquals('none', $jwt->header()->algorithm()->value());
    self::assertTrue($jwt->payload()->isEmpty());
    $jwt = new TestLazyJWT(
      new JWTStruct(new HeaderMapClaimStruct(), new PayloadMapClaimStruct(
        new RegisteredMapClaimStruct(),
        new ArrayMapClaim(),
        new ArrayMapClaim()
      ))
    );
    $header = new URLSafeBase64EncodedStringFromString('{"typ":"JWT","alg":"none"}');
    $payload = new URLSafeBase64EncodedStringFromString('{}');
    self::assertEquals("{$header}.{$payload}", $jwt->encoded());
    self::assertEquals(2, $jwt->header()->count());
    self::assertEquals('none', $jwt->header()->algorithm()->value());
    self::assertTrue($jwt->payload()->isEmpty());
  }

  /**
   * @see https://jwt.io
   * @throws \Throwable
   */
  public function testSignedJWT() {
    $jwt = new TestJWT(
      new JWTStruct(new HeaderMapClaimStruct(
        new RS256OpenSSL(
          new JWTIOKeypair()
        )
      ), new PayloadMapClaimStruct(
        new RegisteredMapClaimStruct(
          null,
          new SubjectStruct('1234567890'),
          null,
          new IssuedAtStruct(new DateTimeTimestampSeconds(1516239022))
        ),
        new ArrayMapClaim([
          new ClaimStruct('name', 'John Doe'),
        ]),
        new ArrayMapClaim([
          new ClaimStruct('admin', true),
        ])
      ))
    );
    /** @noinspection SpellCheckingInspection */
    self::assertEquals(implode('.', [
      'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9',
      implode('', [
        'eyJzdWIiOiIxMjM0NTY3ODkwIiwiaWF0IjoxNTE2MjM5MDIyLCJuYW1lIjoiSm9obiBEb2UiLCJhZ',
        'G1pbiI6dHJ1ZX0',
      ]),
      implode('', [
        'CM4vzuAJkh-oRbD8gOrYlPb-pNKBoOEZoAnxBFVN5yDMbbpRK0WGrBy0HRt4KPQqg8fksbob8xYaXJGT',
        'DmVEeeWL-dJDzc3flTQYGaGeJd4ge4Gp8lMTCboTeOgclmKlvKamqT-qYwQZhuGcNmMdFs1T9_Ni855z',
        'MV5EVb1c6yE',
      ]),
    ]), $jwt->encoded());
  }

  /**
   * @expectedException \Xtuple\Util\Exception\Throwable
   * @expectedExceptionMessage Failed to create a new JSON Web Token
   * @throws \Throwable
   */
  public function testLazyJWTException() {
    $jwt = new TestBrokenLazyJWT();
    $jwt->encoded();
  }

  /**
   * @expectedException \Xtuple\Util\Exception\Throwable
   * @expectedExceptionMessage Failed to encode JSON Web Token
   * @throws \Throwable
   */
  public function testJWTEncodeException() {
    $jwt = new JWTStruct(new HeaderMapClaimStruct(
      new class ('FAIL', -1, new JWTIOKeypair())
        extends AbstractOpenSSLAlgorithm {
      }
    ), new PayloadMapClaimStruct(
      new RegisteredMapClaimStruct(),
      new ArrayMapClaim(),
      new ArrayMapClaim()
    ));
    $jwt->encoded();
  }
}

final class TestJWT
  extends AbstractJWT {
}

final class TestLazyJWT
  extends AbstractLazyJWT {
  /** @var JWT */
  private $jwt;

  public function __construct(JWT $jwt) {
    $this->jwt = new TestJWT($jwt);
  }

  public function header(): HeaderMapClaim {
    return $this->jwt->header();
  }

  public function payload(): PayloadMapClaim {
    return $this->jwt->payload();
  }
}

final class TestBrokenLazyJWT
  extends AbstractLazyJWT {
  public function header(): HeaderMapClaim {
    throw new Exception('Failed header claims');
  }

  public function payload(): PayloadMapClaim {
    throw new Exception('Failed payload claims');
  }
}

/**
 * Returning null instead of resource to cause openssl_sign() failure in AbstractOpenSSLAlgorithm::sign()
 */
final class JWTIOKeypair
  implements Keypair {
  public function serialize() {
    return null;
  }

  public function unserialize($serialized) {
  }

  public function private() {
    $jwtIO = new RSA256FromJWTIO();
    return openssl_pkey_get_private($jwtIO->private());
  }
}
