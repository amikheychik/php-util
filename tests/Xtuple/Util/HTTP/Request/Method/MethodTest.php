<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Method;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\HTTP\Request\Method\Method\CONNECT;
use Xtuple\Util\HTTP\Request\Method\Method\DELETE;
use Xtuple\Util\HTTP\Request\Method\Method\GET;
use Xtuple\Util\HTTP\Request\Method\Method\HEAD;
use Xtuple\Util\HTTP\Request\Method\Method\OPTIONS;
use Xtuple\Util\HTTP\Request\Method\Method\PATCH;
use Xtuple\Util\HTTP\Request\Method\Method\POST;
use Xtuple\Util\HTTP\Request\Method\Method\PUT;
use Xtuple\Util\HTTP\Request\Method\Method\TRACE;

class MethodTest
  extends TestCase {
  public function testString() {
    self::assertEquals('Test', (string) new TestMethod(new MethodString('Test')));
  }

  public function testEnums() {
    self::assertEquals('CONNECT', (string) new CONNECT());
    self::assertEquals('DELETE', (string) new DELETE());
    self::assertEquals('GET', (string) new GET());
    self::assertEquals('HEAD', (string) new HEAD());
    self::assertEquals('OPTIONS', (string) new OPTIONS());
    self::assertEquals('PATCH', (string) new PATCH());
    self::assertEquals('POST', (string) new POST());
    self::assertEquals('PUT', (string) new PUT());
    self::assertEquals('TRACE', (string) new TRACE());
  }
}

final class TestMethod
  extends AbstractMethod {
}
