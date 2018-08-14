<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\Keypair;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\PKCS12\PKCS12File;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Test\AbstractOpenSSLTestCase;
use Xtuple\Util\JWT\Test\RSA256FromJWTIO;
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
    $jwtIO = new RSA256FromJWTIO();
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
