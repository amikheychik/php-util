<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Type\StringOrURI;

use Xtuple\Util\JWT\Claim\Claim;

interface StringOrURIClaim
  extends Claim {
  /**
   * @return string
   */
  public function value();
}
