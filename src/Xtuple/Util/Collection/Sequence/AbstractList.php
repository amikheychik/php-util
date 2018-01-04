<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence;

use Xtuple\Util\Collection\AbstractCollection;

abstract class AbstractList
  extends AbstractCollection
  implements Sequence {
  /** @var Sequence */
  private $list;

  public function __construct(Sequence $list) {
    parent::__construct($list);
    $this->list = $list;
  }

  public final function get(int $key) {
    return $this->list->get($key);
  }
}
