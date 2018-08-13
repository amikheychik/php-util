<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\PKCS12;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\File\File\FileFromPathString;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\AbstractKeypair;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Test\AbstractOpenSSLTestCase;

class PKCS12FileTest
  extends AbstractOpenSSLTestCase {
  /**
   * @throws \Throwable
   */
  public function testPrivate() {
    openssl_pkey_export($this->private, $expected);
    $pkcs12 = new PKCS12File(new FileFromPathString("{$this->directory}/localhost.p12"), $this->password);
    openssl_pkey_export($pkcs12->private(), $private);
    $pkcs12 = new TestAbstractKeypair($pkcs12);
    openssl_pkey_export($pkcs12->private(), $private);
    self::assertEquals($expected, $private);
  }

  /**
   * @expectedException \Xtuple\Util\Exception\Throwable
   * @expectedExceptionMessage Failed to unserialize data
   * @throws \Throwable
   */
  public function testSerialization() {
    openssl_pkey_export($this->private, $expected);
    $pkcs12 = new PKCS12File(new FileFromPathString("{$this->directory}/localhost.p12"), $this->password);
    $pkcs12 = unserialize(serialize($pkcs12));
    openssl_pkey_export($pkcs12->private(), $private);
    self::assertEquals($expected, $private);
    $abstract = new TestAbstractKeypair($pkcs12);
    $abstract = unserialize(serialize($abstract));
    openssl_pkey_export($abstract->private(), $private);
    self::assertEquals($expected, $private);
    rename("{$this->directory}/localhost.p12", "{$this->directory}/temp.p12");
    self::assertEquals(
      'C:87:"Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Keypair\PKCS12\TestAbstractKeypair":2:{N;}',
      serialize($abstract)
    );
    self::assertEquals('N;', serialize($pkcs12));
    rename("{$this->directory}/temp.p12", "{$this->directory}/localhost.p12");
    $damaged = strtr('C:78:"{class}":50:{["\/tmp\/phpunit\/php-util\/openssl\/temp.p12",""]}', [
      '{class}' => PKCS12File::class,
    ]);
    unserialize($damaged);
  }

  /**
   * @throws \Throwable
   */
  public function testPKCS12ParsingException() {
    try {
      openssl_pkey_export($this->private, $expected);
      $pkcs12 = new PKCS12File(new FileFromPathString("{$this->directory}/localhost.csr"), $this->password);
      $pkcs12 = new TestAbstractKeypair($pkcs12);
      $pkcs12->private();
    }
    catch (Throwable $e) {
      self::assertEquals('Failed to parse PKCS#12 Certificate Store data', (string) $e->errors()->get(0));
    }
    finally {
      if (!isset($e)) {
        self::fail('Failed asserting that PKCS#12 parsing exception is thrown.');
      }
    }
  }
}

final class TestAbstractKeypair
  extends AbstractKeypair {
}
