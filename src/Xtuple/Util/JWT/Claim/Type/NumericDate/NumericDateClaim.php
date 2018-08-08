<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Type\NumericDate;

use Xtuple\Util\JWT\Claim\Claim;
use Xtuple\Util\Type\DateTime\DateTime;

/**
 * Interface NumericDateClaim
 *
 * @see https://tools.ietf.org/html/rfc7519#section-2
 */
interface NumericDateClaim
  extends Claim {
  public function datetime(): DateTime;
}
