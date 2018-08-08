<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Request\Header\Collection\Set;

use Xtuple\Util\HTTP\Message\Header\Collection\Set\AbstractSetHeader;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\OAuth2\Client\AccessToken\AccessToken;
use Xtuple\Util\OAuth2\Client\Request\Header\AccessTokenHeader;

final class AccessTokenSetHeader
  extends AbstractSetHeader {
  public function __construct(AccessToken $token) {
    /** @noinspection PhpUnhandledExceptionInspection */
    parent::__construct(new ArraySetHeader([
      new AccessTokenHeader($token),
    ]));
  }
}
