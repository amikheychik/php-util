<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use PHPUnit\Framework\TestCase;

final class URLWithQueryTest
  extends TestCase {
  public function testConstructor() {
    /** @noinspection PhpUnhandledExceptionInspection - $url is verified */
    $url = new URLWithQuery('http://example.com/api', [
      'sort' => [
        'title' => 'ASC',
        'date' => 'DESC',
      ],
    ], 'content');
    self::assertEquals('http://example.com/api?sort%5Btitle%5D=ASC&sort%5Bdate%5D=DESC#content', (string) $url);
  }
}
