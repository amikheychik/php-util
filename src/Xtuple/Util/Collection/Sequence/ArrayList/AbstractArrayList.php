<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Sequence\ArrayList;

use Xtuple\Util\Collection\AbstractArrayCollection;
use Xtuple\Util\Collection\Sequence\Sequence;

abstract class AbstractArrayList
  extends AbstractArrayCollection
  implements Sequence {
  /** @var array */
  private $index;

  public function __construct(array $elements = []) {
    $this->index = array_values($elements);
    parent::__construct($this->index);
  }

  public final function get(int $key) {
    return (isset($this->index[$key]) || array_key_exists($key, $this->index))
      ? $this->index[$key]
      : null;
  }

  public final function key() {
    return (int) parent::key();
  }
}
