<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use PHPUnit\Framework\TestCase;

class BaseURLTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    self::assertEquals(
      'http://example.com/api/v1?sort=ASC&format=grid#header',
      (string) new TestBaseURL('http://example.com/api', '/v1', [
        'sort' => 'ASC',
        'format' => 'grid',
      ], 'header')
    );
    self::assertEquals(
      'http://example.com/api/v1?sort=ASC&format=grid#header',
      (string) new TestBaseURL('http://example.com/', '/api/v1', [
        'sort' => 'ASC',
        'format' => 'grid',
      ], 'header')
    );
  }
}

final class TestBaseURL
  extends AbstractBaseURL {
}
