<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Claim\Collection\Map;

use Xtuple\Util\Collection\Map\AbstractMap;

abstract class AbstractMapClaim
  extends AbstractMap
  implements MapClaim {
  public function __construct(MapClaim $claims) {
    parent::__construct($claims);
  }
}
