<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\Request\Header;

use Xtuple\Util\HTTP\Message\Header\AbstractHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\OAuth2\Client\AccessToken\AccessToken;

final class AccessTokenHeader
  extends AbstractHeader {
  public function __construct(AccessToken $token) {
    parent::__construct(new HeaderStruct(
      'Authorization',
      "{$token->type()} {$token->value()}"
    ));
  }
}
