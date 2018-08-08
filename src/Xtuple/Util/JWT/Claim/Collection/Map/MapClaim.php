<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map;

use Xtuple\Util\Collection\Map\Map;
use Xtuple\Util\JWT\Claim\Claim;

/**
 * Interface Map<Claim>
 */
interface MapClaim
  extends Map {
  /**
   * @return null|Claim
   *
   * @param string $name
   */
  public function get(string $name);

  /**
   * @return null|Claim
   */
  public function current();
}
