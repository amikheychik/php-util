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
    $jwtIO = new TestRSA256FromJWTIO();
    return openssl_pkey_get_private($jwtIO->private());
  }
}

/**
 * Keeping public and private keys as exploded base64 encoding to avoid confusion
 * and impression of storing actual private key in repository.
 */
final class TestRSA256FromJWTIO {
  /**
   * @see https://jwt.io - Algorithm RS256 public key
   * @return string
   */
  public function public(): string {
    /** @noinspection SpellCheckingInspection */
    return base64_decode(implode('', [
      'LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0KTUlHZk1BMEdDU3FHU0liM0RRRUJBUVVBQTRHTkFEQ',
      '0JpUUtCZ1FEZGxhdFJqUmpvZ28zV29qZ0dIRkhZTHVnZApVV0FZOWlSM2Z5NGFyV05BMUtvUzhrVn',
      'czM2NKaWJYcjhidndVQVVwYXJDd2x2ZGJINmR2RU9mb3UwL2dDRlFzCkhVZlFyU0R2K011U1VNQWU',
      '4anpLRTRxVytqSyt4UVU5YTAzR1VuS0hra2xlK1EwcFgvZzZqWFo3cjEveEFLNUQKbzJrUStYNXhL',
      'OWNpcFJnRUt3SURBUUFCCi0tLS0tRU5EIFBVQkxJQyBLRVktLS0tLQ==',
    ]));
  }

  /**
   * @see https://jwt.io - Algorithm RS256 private key
   * @return string
   */
  public function private(): string {
    /** @noinspection SpellCheckingInspection */
    return base64_decode(implode('', [
      'LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpNSUlDV3dJQkFBS0JnUURkbGF0UmpSam9nb',
      'zNXb2pnR0hGSFlMdWdkVVdBWTlpUjNmeTRhcldOQTFLb1M4a1Z3CjMzY0ppYlhyOGJ2d1VBVXBhck',
      'N3bHZkYkg2ZHZFT2ZvdTAvZ0NGUXNIVWZRclNEditNdVNVTUFlOGp6S0U0cVcKK2pLK3hRVTlhMDN',
      'HVW5LSGtrbGUrUTBwWC9nNmpYWjdyMS94QUs1RG8ya1ErWDV4SzljaXBSZ0VLd0lEQVFBQgpBb0dB',
      'RCtvbkF0VnllNGljN1ZSN1Y1MERGOWJPbndSd05YckFSY0RocTlMV05SclJHRWxFU1lZVFE2RWJhd',
      'FhTCjNNQ3lqalgyZU1odS9hRjVZaFhCd2twcHd4ZytFT21YZWgrTXpMN1poMjg0T3VQYmtnbEFhR2',
      'hWOWJiNi81Q3AKdUdiMWVzeVBiWVcrVHkyUEMwR1NaZklYa1hzNzZqWEF1OVRPQnZEMHliYzJZbGt',
      'DUVFEeXdnMlIvN3QzUTJPRQoyK3lvMzgyQ0xKZHJsU0xWUk9XS3diNHRiMlBqaFk0WEF3VjhkMXZ5',
      'MFJlbnhUQitLNU11NTd1VlNUSHRyTUswCkdBdEZyODMzQWtFQTZhdngyME9IbzYxWWVsYS80azVrU',
      'UR0akVmMU4wTGZJK0JjV1p0eHNTM2pETTNpMUhwMEsKU3,U1cnNDUGI4YWNKbzVSTzI2Z0dWcmZBc',
      '0RjSVhLQytiUUpBWloyWElwc2l0THlQcHVpTU92QmJ6UGF2ZDRnWQo2WjhLV3JmWXpKb0kvUTlGdU',
      'JvNnJLd2w0QkZvVG9EN1dJVVMraHBrYWd3V2l6KzZ6TG9YMWRiT1p3SkFDbUg1CmZTU2pBa0xSaTU',
      '0UEtKOFRGVWVPUDE1aDlzUXp5ZEk4ekpVK3VwdkRFS1pzWmMvVWhUL1N5U0RPeFE0Ry81MjMKWTBz',
      'ei9PWnRTV2NvbC9VTWdRSkFMZXN5KytHZHZvSURMZkpYNUdCUXB1RmdGZW5SaVJEYWJ4ckU5TU5VW',
      'jJhUApGYUZwK0R5QWUrYjRuRHd1SmFXMkxVUmJyOEFFWmdhN29RajB1WXhjWXc9PQotLS0tLUVORC',
      'BSU0EgUFJJVkFURSBLRVktLS0tLQ==',
    ]));
  }
}
