<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Request\Header\Collection\Set;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\OAuth2\Client\Token\Access\AccessTokenStruct;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;
use Xtuple\Util\Type\UUID\UUIDv4;

class AccessTokenSetHeaderTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $uuid = new UUIDv4();
    $now = time();
    $headers = new AccessTokenSetHeader(new AccessTokenStruct(
      (string) $uuid,
      'Bearer',
      new TimestampStruct($now),
      null
    ));
    self::assertEquals(1, $headers->count());
    $header = $headers->get('Authorization');
    self::assertEquals('Authorization', $header->name());
    self::assertEquals("Bearer {$uuid}", $header->value());
    self::assertEquals("Authorization: Bearer {$uuid}", (string) $header);
  }
}
