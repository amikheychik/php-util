<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Cache;

use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\Cache\Record\AbstractRecord;
use Xtuple\Util\Cache\Record\RecordStruct;
use Xtuple\Util\OAuth2\Client\AccessToken\AccessToken;
use Xtuple\Util\Type\DateTime\DateTimeTimestamp;

final class RecordAccessToken
  extends AbstractRecord {
  public function __construct(Key $key, AccessToken $token) {
    /** @noinspection PhpUnhandledExceptionInspection */
    parent::__construct(new RecordStruct(
      $key,
      $token,
      new DateTimeTimestamp($token->expiresAt())
    ));
  }
}
