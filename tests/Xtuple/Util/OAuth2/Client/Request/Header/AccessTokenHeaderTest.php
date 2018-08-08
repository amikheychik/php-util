<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Request\Header;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\OAuth2\Client\AccessToken\AccessTokenStruct;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;
use Xtuple\Util\Type\UUID\UUIDv4;

class AccessTokenHeaderTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $uuid = new UUIDv4();
    $now = time();
    $header = new AccessTokenHeader(new AccessTokenStruct(
      (string) $uuid,
      'Bearer',
      new TimestampStruct($now)
    ));
    self::assertEquals('Authorization', $header->name());
    self::assertEquals("Bearer: {$uuid}", $header->value());
    self::assertEquals("Authorization: Bearer: {$uuid}", (string) $header);
  }
}
