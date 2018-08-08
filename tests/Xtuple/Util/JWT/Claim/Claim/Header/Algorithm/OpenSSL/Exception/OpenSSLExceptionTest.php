<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Exception;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\JWT\Claim\Claim\Header\Algorithm\OpenSSL\Test\AbstractOpenSSLTestCase;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

class OpenSSLExceptionTest
  extends AbstractOpenSSLTestCase {
  public function testConstructor() {
    self::assertFalse(openssl_pkcs12_read('', $certificates, $this->password));
    $previous = new Exception('Previous exception');
    $exception = new OpenSSLException(new MessageWithTokens('Error message'), $previous, 1);
    self::assertEquals('Error message', (string) $exception->errors()->get(0));
    self::assertEquals(1, $exception->getCode());
    self::assertSame($previous, $exception->getPrevious());
    self::assertStringEndsWith('configuration file routines:NCONF_get_string:no value', $exception->getMessage());
  }
}
