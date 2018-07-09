<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Map\ArrayMap;

use Xtuple\Util\Collection\AbstractArrayCollection;
use Xtuple\Util\Collection\Map\Map;

abstract class AbstractArrayMap
  extends AbstractArrayCollection
  implements Map {
  /** @var array */
  private $index;

  public function __construct(iterable $elements = [], ?callable $map = null) {
    $this->index = [];
    foreach ($elements as $i => $element) {
      $i = (string) ($map ? $map($element) : $i);
      $this->index[$i] = $element;
    }
    parent::__construct($this->index);
  }

  public final function get(string $key) {
    return $this->index[$key] ?? null;
  }

  public final function key() {
    return (string) parent::key();
  }
}
