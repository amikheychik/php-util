<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Map;

use Xtuple\Util\Collection\AbstractCollection;

abstract class AbstractMap
  extends AbstractCollection
  implements Map {
  /** @var Map */
  private $map;

  public function __construct(Map $map) {
    parent::__construct($map);
    $this->map = $map;
  }

  public final function get(string $key) {
    return $this->map->get($key);
  }
}
