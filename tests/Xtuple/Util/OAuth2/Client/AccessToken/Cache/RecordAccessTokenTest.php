<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Cache;

use PHPUnit\Framework\TestCase;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\OAuth2\Client\AccessToken\AccessTokenStruct;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampStruct;
use Xtuple\Util\Type\UUID\UUIDv4;

class RecordAccessTokenTest
  extends TestCase {
  /**
   * @throws \Throwable
   */
  public function testConstructor() {
    $token = new UUIDv4();
    $now = time();
    $record = new RecordAccessToken(
      new KeyStruct(['test']),
      new AccessTokenStruct((string) $token, 'bearer', new TimestampStruct($now))
    );
    self::assertEquals(['test'], $record->key()->fields());
    self::assertEquals((string) $token, $record->value()->value());
    self::assertEquals('bearer', $record->value()->type());
    self::assertTrue($record->expiresAt()->equals(new DateTimeTimestampSeconds($now)));
  }
}
