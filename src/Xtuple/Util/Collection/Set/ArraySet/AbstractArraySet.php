<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Set\ArraySet;

use Xtuple\Util\Collection\AbstractArrayCollection;
use Xtuple\Util\Collection\Set\Set;

abstract class AbstractArraySet
  extends AbstractArrayCollection
  implements Set {
  /** @var array */
  private $index;

  public function __construct(iterable $elements = [], ?callable $map = null) {
    $this->index = [];
    foreach ($elements as $i => $element) {
      $i = (string) ($map ? call_user_func($map, $element) : $i);
      if (isset($this->index[$i])) {
        throw new \InvalidArgumentException(strtr('Element {i} is duplicated', [
          '{i}' => $i,
        ]));
      }
      $this->index[$i] = $element;
    }
    parent::__construct($this->index);
  }

  public function get(string $key) {
    return $this->index[$key] ?? null;
  }
}
