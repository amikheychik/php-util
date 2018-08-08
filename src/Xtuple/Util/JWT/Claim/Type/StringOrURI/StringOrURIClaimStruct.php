<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Type\StringOrURI;

use Xtuple\Util\JWT\Claim\AbstractClaim;
use Xtuple\Util\JWT\Claim\ClaimStruct;

/**
 * Class Claim<StringOrURI>
 *
 * @see https://tools.ietf.org/html/rfc7519#section-2
 * @see https://tools.ietf.org/html/rfc3986
 */
final class StringOrURIClaimStruct
  extends AbstractClaim
  implements StringOrURIClaim {
  public function __construct(string $name, string $stringOrURI) {
    parent::__construct(new ClaimStruct($name, $stringOrURI));
  }
}
