<?php declare(strict_types=1);

namespace Xtuple\Util\OAuth2\Client\AccessToken\Request;

use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\Type\DateTime\Timestamp\Timestamp;

interface AccessTokenRequest
  extends Request {
  public function key(): Key;

  public function issuedAt(): Timestamp;
}
