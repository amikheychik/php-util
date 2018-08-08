<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Test;

use PHPUnit\Framework\TestCase;

abstract class AbstractOpenSSLTestCase
  extends TestCase {
  /** @var string */
  protected $directory = '/tmp/phpunit/php-util/openssl';
  /** @var resource - OpenSSL private key */
  protected $private;
  /** @var string - P12 password */
  protected $password;

  /**
   * @throws \Throwable
   */
  protected function setUp() {
    parent::setUp();
    if (!file_exists($this->directory)) {
      mkdir($this->directory, 0777, true);
    }
    $this->private = openssl_pkey_new([
      'private_key_bits' => 2048,
      'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ]);
    openssl_pkey_export_to_file($this->private, "{$this->directory}/private.pem");
    $csr = openssl_csr_new([
      'commonName' => 'localhost',
      'countryName' => 'US',
      'stateOrProvinceName' => 'Virginia',
      'localityName' => 'Norfolk',
      'organizationName' => 'xTuple',
      'organizationalUnitName' => 'Development',
    ], $this->private);
    openssl_csr_export_to_file($csr, "{$this->directory}/localhost.csr");
    $crt = openssl_csr_sign($csr, null, $this->private, 365);
    openssl_x509_export_to_file($crt, "{$this->directory}/localhost.crt");
    $this->password = random_bytes(32);
    openssl_pkcs12_export_to_file($crt, "{$this->directory}/localhost.p12", $this->private, $this->password);
  }

  protected function tearDown() {
    parent::tearDown();
    $directory = new \DirectoryIterator($this->directory);
    foreach ($directory as $file) {
      if (!$file->isDot()) {
        unlink($file->getRealPath());
      }
    }
    rmdir($this->directory);
  }
}
