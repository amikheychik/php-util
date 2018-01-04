<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set;

use Xtuple\Util\Collection\AbstractCollection;

abstract class AbstractSet
  extends AbstractCollection
  implements Set {
  /** @var Set */
  private $set;

  public function __construct(Set $set) {
    parent::__construct($set);
    $this->set = $set;
  }

  public final function get(string $key) {
    return $this->set->get($key);
  }
}
