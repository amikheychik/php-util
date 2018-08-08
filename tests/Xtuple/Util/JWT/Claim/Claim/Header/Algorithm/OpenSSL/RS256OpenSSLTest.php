<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\Keypair;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\PKCS12\PKCS12File;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Test\AbstractOpenSSLTestCase;
use Xtuple\Util\Type\String\Encoding\Base64\Encode\URLSafe\URLSafeBase64EncodedStringFromString;

class RS256OpenSSLTest
  extends AbstractOpenSSLTestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $algorithm = new RS256OpenSSL(
      new PKCS12File(new FileFromPathString("{$this->directory}/localhost.p12"), $this->password)
    );
    self::assertEquals('alg', $algorithm->name());
    self::assertEquals('RS256', $algorithm->value());
  }

  /**
   * @see https://jwt.io
   * @throws \Throwable
   */
  public function testSignature() {
    $header = new URLSafeBase64EncodedStringFromString('{"alg":"RS256","typ":"JWT"}');
    /** @noinspection SpellCheckingInspection */
    self::assertEquals('eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9', $header);
    $content = new URLSafeBase64EncodedStringFromString(
      '{"sub":"1234567890","name":"John Doe","admin":true,"iat":1516239022}'
    );
    /** @noinspection SpellCheckingInspection */
    self::assertEquals(
      'eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWUsImlhdCI6MTUxNjIzOTAyMn0',
      $content
    );
    $jwtIO = new TestRSA256FromJWTIO();
    $private = openssl_pkey_get_private($jwtIO->private());
    $csr = openssl_csr_new([
      'commonName' => 'localhost',
    ], $private);
    $crt = openssl_csr_sign($csr, null, $private, 1);
    openssl_pkcs12_export_to_file($crt, "{$this->directory}/jwt-io.p12", $private, 'jwt.io');
    $algorithm = new RS256OpenSSL(
      new PKCS12File(new FileFromPathString("{$this->directory}/jwt-io.p12"), 'jwt.io')
    );
    self::assertEquals(1, openssl_verify(
      "{$header}.{$content}",
      $algorithm->sign("{$header}.{$content}"),
      $jwtIO->public(),
      OPENSSL_ALGO_SHA256
    ));
    /** @noinspection SpellCheckingInspection */
    self::assertEquals(
      implode('', [
        'TCYt5XsITJX1CxPCT8yAV-TVkIEq_PbChOMqsLfRoPsnsgw5WEuts01mq-pQy7UJiN5mgRxD-WUcX',
        '16dUEMGlv50aqzpqh4Qktb3rk-BuQy72IFLOqV0G_zS245-kronKb78cPN25DGlcTwLtjPAYuNzVB',
        'Ah4vGHSrQyHUdBBPM',
      ]),
      new URLSafeBase64EncodedStringFromString(
        $algorithm->sign("{$header}.{$content}")
      )
    );
  }

  public function testSignatureMissingFileException() {
    try {
      $algorithm = new RS256OpenSSL(
        new PKCS12File(new FileFromPathString("{$this->directory}/localhost.p12"), $this->password)
      );
      rename("{$this->directory}/localhost.p12", "{$this->directory}/temp.p12");
      $algorithm->sign('');
    }
    catch (\Throwable $e) {
      rename("{$this->directory}/temp.p12", "{$this->directory}/localhost.p12");
      self::assertEquals('Failed to sign data', $e->getMessage());
      self::assertEquals(
        'File /tmp/phpunit/php-util/openssl/localhost.p12 not found',
        $e->getPrevious()->getMessage()
      );
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed asserting that signature exception is thrown.');
      }
    }
  }

  public function testSignatureWrongAlgorithmException() {
    try {
      $algorithm = new WrongOpenSSLAlgorithm(
        new PKCS12File(new FileFromPathString("{$this->directory}/localhost.p12"), $this->password)
      );
      $algorithm->sign('');
    }
    catch (Throwable $e) {
      self::assertEquals('Failed to sign data', $e->getMessage());
      // openssl_sign() may either throw its own exception or return false,
      // but behavior depends on the scope of phpunit run
      if ($e->errors() && !$e->errors()->isEmpty()) {
        self::assertEquals('Failed to create signature', (string) $e->errors()->get(0));
      }
      else {
        self::assertEquals(
          'openssl_sign(): Unknown signature algorithm.',
          $e->getPrevious()->getMessage()
        );
      }
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed asserting that openssl_sign() unknown signature algorithm exception is thrown.');
      }
    }
  }

  public function testSignatureWrongPrivateKeyException() {
    try {
      $algorithm = new RS256OpenSSL(new TestKeypair());
      $algorithm->sign('');
    }
    catch (Throwable $e) {
      self::assertEquals('Failed to sign data', $e->getMessage());
      // openssl_sign() may either throw its own exception or return false,
      // but behavior depends on the scope of phpunit run
      if ($e->errors() && !$e->errors()->isEmpty()) {
        self::assertEquals('Failed to create signature', (string) $e->errors()->get(0));
      }
      else {
        self::assertEquals(
          'openssl_sign(): supplied key param cannot be coerced into a private key',
          $e->getPrevious()->getMessage()
        );
      }
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed asserting that openssl_sign() private key exception is thrown.');
      }
    }
  }
}

/**
 * Using incorrect algorithm value to test sign() failure.
 */
final class WrongOpenSSLAlgorithm
  extends AbstractOpenSSLAlgorithm {
  public function __construct(Keypair $key) {
    parent::__construct('WRONG', -1, $key);
  }
}

/**
 * Returning null instead of resource to cause openssl_sign() failure in AbstractOpenSSLAlgorithm::sign()
 */
final class TestKeypair
  implements Keypair {
  public function serialize() {
    return null;
  }

  public function unserialize($serialized) {
  }

  public function private() {
    return null;
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
