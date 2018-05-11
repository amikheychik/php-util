<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Type\Stream\String\StringStreamFromResource;

final class QueryBodyTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testBody() {
    $body = new QueryBody([
      'sort' => 'ASC',
      'filter' => [
        'field' => 'title',
        'operator' => 'LIKE',
        'value' => 'abc',
      ],
    ]);
    $expected = 'sort=ASC&filter%5Bfield%5D=title&filter%5Boperator%5D=LIKE&filter%5Bvalue%5D=abc';
    self::assertEquals($expected, (string) $body);
    self::assertEquals($expected, $body->content());
    self::assertEquals($expected, (string) new StringStreamFromResource($body->resource()));
  }
}
